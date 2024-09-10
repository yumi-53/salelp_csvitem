document.addEventListener('DOMContentLoaded', function () {
    const selectli = document.getElementsByClassName('select_menu-item'); // li全取得


    // console.log(selectli);
    for (let i = 0; i < selectli.length; i++) {
        selectli[i].addEventListener('click', changeItem, false);
    }
    // セレクトメニューボタンをクリックすると実行
    function changeItem(e) {
        // セレクトのis-activeついてるやつ抹殺、
        document.getElementsByClassName('is-active')[0].classList.remove('is-active');
        // セレクトのクリックされたliにis-active付与
        this.classList.add('is-active');        
        
        // アイテムのis-displayついてるやつ抹殺
        const hiddenItem = document.getElementsByClassName('items');
        for (var i = 0; i < hiddenItem.length; i++) {
            hiddenItem[i].classList.remove('is-display');
        }
        // クリックされたliのdata-tab名取得
        const itemKey = e.currentTarget.dataset.tab

        // クリックされたliのdata-tab名取得
        const item = document.getElementsByClassName(itemKey);
        for (var i = 0; i < item.length; i++) {
            item[i].classList.add('is-display');
        }
    };
}, false);

