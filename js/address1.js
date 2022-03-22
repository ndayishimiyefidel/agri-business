// function OpenPopupCenter(pageURL, title, w, h) {
//     var left = (screen.width - w) / 2;
//     var top = (screen.height - h) / 4; // for 25% - devide by 4  |  for 33% - devide by 3
//     var targetWin = window.open(pageURL, title,
//         'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' +
//         w + ', height=' + h + ', top=' + top + ', left=' + left);
// }


let provincesSelector = document.querySelector('#province');
let districtSelector = document.querySelector('#district');
let sectorSelector = document.querySelector('#sector');
let cellSelector = document.querySelector('#cell');
let villageSelector = document.querySelector('#village');

// fetch data
const url = './Inventory/dist/js/data.json';
fetch(url)
    .then((response) => {
        if (response.status !== 200) {
            console.log('Looks like there was a problem. Status Code: ' + response.status);
            return;
        }
        response.json().then((data) => {
            let option;
            let provincesKeys   = Object.keys(data);
            for (let i = 0; i < provincesKeys  .length; i++) {
                option = document.createElement('option');
                option.text = provincesKeys  [i];
                option.value = provincesKeys  [i];
                provincesSelector.add(option);
            }
            provincesSelector.addEventListener('change', (e) => allDistricts(data[e.target.value]));
        });
    })
    .catch((err) => {
        console.error('Fetch Error -', err);
    });

const allDistricts = (data) => {
    let districtsKeys = Object.keys(data);
    districtSelector.innerHTML = '';
    for (let i = 0; i < districtsKeys.length; i++) {
        option = document.createElement('option');
        option.text = districtsKeys[i];
        option.value = districtsKeys[i];
        districtSelector.add(option);
    }
    districtSelector.addEventListener('change', (e) => allSectors(data[e.target.value]));
};

const allSectors = (data) => {
    let sectorsKeys = Object.keys(data);
    sectorSelector.innerHTML = '';
    for (let i = 0; i < sectorsKeys.length; i++) {
        option = document.createElement('option');
        option.text = sectorsKeys[i];
        option.value = sectorsKeys[i];
        sectorSelector.add(option);
    }
    sectorSelector.addEventListener('change', (e) => allCells(data[e.target.value]));
};

const allCells = (data) => {
    let cellsKeys = Object.keys(data);
    cellSelector.innerHTML = '';
    for (let i = 0; i < cellsKeys.length; i++) {
        option = document.createElement('option');
        option.text = cellsKeys[i];
        option.value = cellsKeys[i];
        cellSelector.add(option);
    }
    cellSelector.addEventListener('change', (e) => allVillages(data[e.target.value]));
};

const allVillages = (data) => {
    villageSelector.innerHTML = '';
    for (let i = 0; i < data.length; i++) {
        option = document.createElement('option');
        option.text = data[i];
        option.value = data[i];
        villageSelector.add(option);
    }
};