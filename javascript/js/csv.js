async function loadCSVData() {
    const response = await fetch('itemdata.csv');
    const text = await response.text();
    const data = text.trim().split('\n')
        .map(line => line.split(',').map(x => x.trim()));
    const itemList = data.slice(1)
        .map(x => `
        <li class="item is-display ${x[0]} items">
            <a class="item_url" href="https://item.rakuten.co.jp/vogue-sports/${x[1]}" target="_blank">
                <ul>
                    <li class="item_img"><img src="${x[2]}"></li>
                    <li class="item_icom mb_30"">
                        <span class="${x[3]}">${x[4]}</span>
                        <span class="${x[5]}"></span>
                        <span class="${x[6]}"></span>
                    </li>
                    <li class="item_price">
                        <span class="item_egularprice">${x[9]}円</span>
                        <span class="item_saleprice">${x[10]}円</span>
                    </li>
                </ul>
            </a>
        </li>

        `)
    .join('');
    document.getElementById('js-csv').innerHTML = itemList;
}

loadCSVData();