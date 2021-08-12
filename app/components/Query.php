<?php

namespace components;

use Yii;

/**
 * Extend for yii\db\Query class
 *
 * For example,
 *
 * ```php
 * $query = new Query;
 * // compose the query
 * $query->select('id, name')
 *     ->from('user')
 *     ->limit(10)
 *     ->with('SELECT ...',true,'r')
 *     ->innerJoin('r','r."ID" = c."OWNER"');
 * $rows = $query->all();
 * // alternatively, you can create DB command and execute it
 * $command = $query->createCommand();
 * // $command->sql returns the actual SQL
 * $rows = $command->queryAll();
 * ```
 *
 * @author Artyomov Anton <art...ail.com>
 */
class Query extends \yii\db\Query
{

    private $with;
    private $is_recursive;
    private $alias;

    /**
     * Adding sql expression before select operator
     * @param yii\db\Query $w
     * @param boolean $is_recursive
     * @param string $alias
     * @return $this
     */
    public function with($w, $is_recursive = true, $alias = 'r')
    {
        $this->is_recursive = $is_recursive;
        $this->alias        = $alias;

        if ($w instanceof yii\db\Query) {
            $this->with = $w->createCommand()->rawSql;
        } else {
            $this->with = $w;
        }

        return $this;
    }

    /**
     * Creates a DB command that can be used to execute this query.
     * @param Connection $db the database connection used to generate the SQL statement.
     * If this parameter is not given, the `db` application component will be used.
     * @return Command the created DB command instance.
     */
    public function createCommand($db = null)
    {
        if ($db === null) {
            $db = Yii::$app->getDb();
        }
        list($sql, $params) = $db->getQueryBuilder()->build($this);

        if (!empty($this->with)) {
            $sql = 'WITH ' . ( $this->is_recursive ? 'RECURSIVE ' : '')
                    . $this->alias . ' AS (' . $this->with . ') ' . $sql;
        }

        return $db->createCommand($sql, $params);
    }

    public function count($q = '*', $db = null)
    {
        if (!empty($this->with)) {

            if ($db === null) {
                $db = Yii::$app->getDb();
            }
            list($sql, $params) = $db->getQueryBuilder()->build($this);
            
            $sql = 'WITH ' . ( $this->is_recursive ? 'RECURSIVE ' : '')
                    . $this->alias . ' AS (' . $this->with . ') SELECT COUNT(*) FROM (' . $sql . ') c' ;
            
            return $db->createCommand($sql, $params)->queryScalar();
        }

        return $this->queryScalar("COUNT($q)", $db);
    }

}