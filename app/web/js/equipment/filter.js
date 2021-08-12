(function(w, d, $){
    let dropDowns = [];

    let depth = 0;
    const selectSectionsDropDown = $('#sectionsDropDown');

    function addDropDown(options) {
        //const dropDownWrapper = $(`#sectionDropDownWrapper${depth}`);
        //const dropDown = $(`#sectionDropDown${depth}`);

        //console.log('dsdsdsdsd');

        const lastDropDown = dropDowns[dropDowns.length - 1];

        const lastDropDownEl = $(`#${lastDropDown}`).after()


        dropDownWrapper.show();
    }

    selectSectionsDropDown.on('change', function(e) {
        console.log(this.value);

        $.ajax({
            url: `/section/get-childs?pid=${this.value}`,
            method: 'GET',
            success: function(...response) {
                const result = JSON.parse(response[0])

                const resultValues = Object.values(result);

                const data = Object.keys(result).map((el, index) => {
                    return {
                        id: parseInt(el),
                        name: resultValues[index]
                    }
                });

                console.log(data)


            }
        })
    })
}(window, document, jQuery))