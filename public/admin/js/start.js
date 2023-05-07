const genders = ["Male", "Female", "Other"];
function getData(_data) {
    let d = [];
    for (const key in _data) {
        if (Object.hasOwnProperty.call(_data, key)) {
            const element = _data[key];
            d[key] = [];
            if (element != null) {

                arr = element.split(',');
                arr.forEach(element_inner => {
                    d[key].push(element_inner.split(':'));
                });
            }
        }
    }
    console.log(d);
    return d;

}

function getDataSpecific(_data, arr) {
    let d = [];
    arr.forEach(key => {
        if (Object.hasOwnProperty.call(_data, key)) {
            const element = _data[key];
            d[key] = [];
            if (element != null) {

                arr = element.split(',');
                arr.forEach(element_inner => {
                    d[key].push(element_inner.split(':'));
                });
            }
        }
    });

    // console.log(d);
    return d;

}

function mapData(l1, l2) {
    d = [];

    l1.forEach(_l1 => {
        let c = 0;
        l2.forEach(_l2 => {
            if (_l1[0] == _l2[0]) {
                d.push([_l1[1], _l2[1]]);
                c += 1;
            }

        });
        if (c == 0) {
            d.push([_l1[1], 0]);
        }
    });

    return d;


}

function getOptions(_data, i) {
    if (i == undefined || i == null) {
        i = 1;
    }
    let html = '';
    _data.forEach(e => {
        html += "<option value='" + e[0] + "'>" + e[i] + "</option>"
    });
    return html;
}

function anotherSelect(arr, val, i) {
    _arr = [];
    for (let index = 0; index < arr.length; index++) {
        const ele = arr[index];
        if (ele[i] == val) {
            _arr.push(ele);
        }
    }
    return _arr;
}

function renderDataList(name, list) {
    html = "<datalist id='data-" + name + "'>"
    list.forEach(ele => {

        html += "<option value='" + ele + "'>" + ele + "</option>"
    });
    html += "</datalist>";
    document.write(html);
}


function initSwitch() {
    $('[switch]').each(function (index, ele) {
        const sw = ele.dataset.switch;
        if (!ele.checked) {
            $(sw).hide();
        } else {
            $(sw).show();
        }
        $(ele).click(function (e) {
            if (!ele.checked) {
                $(sw).hide();
            } else {
                $(sw).show();
            }

        });

    });
}

function doSwitch(ele) {
    const sw = ele.dataset.switch;
    if (!ele.checked) {
        $(sw).hide();
    } else {
        $(sw).show();
    }
}


function block(ele) {
    $(ele).block({ message: '<div class="spinner-grow text-primary" role="status"><span class="sr-only">Loading...</span></div>' });
}

function unblock(ele) {
    $(ele).unblock();
}

function formatDate(_date) {
    year = _date.getFullYear();
    month = _date.getMonth() + 1;
    day = _date.getDate();
    return year + '-' + (month < 10 ? ('0' + month) : month) + '-' + (day < 10 ? ('0' + day) : day);
}


function startFocusSelect() {
    $('input.focus-select').focus(function () {
        this.select();
        this.selectAll();

    });

}

function template(str, obj) {
    var t = '';
    console.log(obj);
    i = 0;
    for (const key in obj) {
        if (obj.hasOwnProperty.call(obj, key)) {
            const element = obj[key];
            if (i++ == 0) {

                t = str.replaceAll('xxx_' + key, element);
            } else {
                t = t.replaceAll('xxx_' + key, element);

            }
        }
    }
    return t;
}

function strReplaceAll(str, searchArr, replaceArr) {
    var t = '';
    for (let index = 0; index < searchArr.length; index++) {
        const search = searchArr[index];
        const replace = replaceArr[index];
        if (index == 0) {
            t = str.replaceAll(search, replace);
        } else {
            t = t.replaceAll(search, replace);
        }
    }
    return t;
}