/**
 * Created by ChenTsu on 17.08.16.
 *
 * Домашнее задание - сделайте любой один из двух плагинов:
 *
 * 1) улучшенный клон input type="number"  - сделайте объект CounterField,
 * который, будучи примененным к текстовому полю добавляет после него кнопки + и -,
 * изменяющие значения на один больше/меньше (можно не применять к текстовому полю,
 * а создавать в контейнере, как на занятии).
 *
 * Факультативно - дайте возможность через опции установить возможность шага, минимум и максимум, а также,
 * заблокируйте пользовательский ввод с клавиатуры в поле ввода.
 *
 * FAQ:
 * q: input должен быть type number в дз?
 * a: нет, input type = text, вы клонируете поведение number
 *
 * 2) in-place редактирование.
 * - сделайте возможность подключить объект к любому тегу на странице.
 * после клика на этот тег содержимое тега должно меняться на текстовое поле ввода, с кнопкой ОК после него.
 * Значение текстового поля должно соответствовать содержимому тега.
 * По нажатию кнопки ОК содержимое тега должно обновляться в соответствии с измененным содержимым input.
 *
 * Задачи новые - если что-то неясно - любые вопросы - мне в скайп и в наш чат.
 * И, кстати, логин в скайпе - dustyo_O - добавляйтесь
 */


function CounterField(nodeElement, step, min, max, keylock )
{
    if ( typeof ( step ) === 'undefined' ) step = 1;
    if ( typeof ( min ) === 'undefined' ) min = 0;
    if ( typeof ( max ) === 'undefined' ) max = 25;
    if ( nodeElement.value === '' ) nodeElement.value = 0;

    console.log(nodeElement.value);

    if ( typeof ( keylock ) === 'undefined' ) keylock = false;

    this.setStep = function (newStep) {
        if ( typeof ( step ) === 'undefined' ) step = 1;
        else step = newStep;
    };
    this.setMin = function (newMin) {
        if ( typeof ( min ) === 'undefined' ) min = 0;
        else min = newMin;
    };
    this.setMax = function (newMax) {
        if ( typeof ( max ) === 'undefined' ) max = 25;
        else max = newMax;
    };

    if ( keylock ) nodeElement.setAttribute('disabled','');

    this.inition = function () {
        // alert ('function inition');
        // nodeElement = that.nodeElement;
        var container = document.createElement('div');
        // container.classList.add('row');
        // container =

        // кнопка '+'
        var tmp = document.createElement('button');
        tmp.setAttribute('type', 'button');
        tmp.classList.add('col-lg-1');
        tmp.innerHTML = '+';
        tmp.onclick = function ()
        {
            var x = parseInt(nodeElement.value);

            if ( this.parentNode.lastChild.nodeName === 'P')
            {
                this.parentNode.lastChild.remove();
                nodeElement.parentNode.classList.remove( 'has-warning' );
            }

            if ( (x + step) <= max ) {
            // TODO добавить округление до максимального допустимого значения если шаг его превышает, а текущее значение меньше максимального
                nodeElement.value = x + step;
            }
            else {
                x = document.createElement('p');
                x.classList.add('help-block');
                x.textContent= 'Максимальное значение поля = ' + max;
                this.parentNode.appendChild( x );
                nodeElement.parentNode.classList.add('has-warning');
            }

        };
        container.appendChild(tmp);

        // кнопка '-'
        tmp = document.createElement('button');
        tmp.setAttribute('type', 'button');
        tmp.classList.add('col-lg-1');
        tmp.innerHTML = '-';
        tmp.onclick = function () {
            var x = parseInt(nodeElement.value);
            if ( this.parentNode.lastChild.nodeName === 'P')
            {
                this.parentNode.lastChild.remove();
                nodeElement.parentNode.classList.remove( 'has-warning' );
            }
            if ( (x - step) >= min ) {
                nodeElement.value = x - step;
            }
            else {
                x = document.createElement('p');
                x.classList.add('help-block');
                x.textContent= 'Минимальное значение поля = ' + min;
                this.parentNode.appendChild( x );
                nodeElement.parentNode.classList.add('has-warning');
            }
        };
        container.appendChild(tmp);

        //////// свёрток 'options' - мини форму для изменения шага, мин, макс.
            tmp = document.createElement('div');
            tmp.classList.add('panel-group');
            tmp.classList.add('col-lg-4');
            tmp.setAttribute('id','accordion');
            tmp.appendChild( document.createElement('div'));
            tmp.firstElementChild.classList.add('panel');
            tmp.firstElementChild.classList.add('panel-default');
            tmp.firstElementChild.appendChild( document.createElement('div'));
            tmp.firstElementChild.firstElementChild.classList.add('panel-heading');
            tmp.firstElementChild.firstElementChild.appendChild( document.createElement('h4'));
            tmp.firstElementChild.firstElementChild.firstElementChild.classList.add('panel-title');
            tmp.firstElementChild.firstElementChild.firstElementChild.appendChild( document.createElement('a'));
            tmp.firstElementChild.firstElementChild.firstElementChild.firstElementChild.setAttribute('href','#collapseOptions');
            tmp.firstElementChild.firstElementChild.firstElementChild.firstElementChild.setAttribute('data-parent',"#accordion");
            tmp.firstElementChild.firstElementChild.firstElementChild.firstElementChild.setAttribute('data-toggle',"collapse");
            tmp.firstElementChild.firstElementChild.firstElementChild.firstElementChild.setAttribute('aria-expanded',"false");
            tmp.firstElementChild.firstElementChild.firstElementChild.firstElementChild.classList.add('collapsed');
            tmp.firstElementChild.firstElementChild.firstElementChild.firstElementChild.textContent = 'настройка';
            tmp.firstElementChild.appendChild( document.createElement('div'));
            tmp.firstElementChild.lastElementChild.classList.add('panel-collapse');
            tmp.firstElementChild.lastElementChild.classList.add('collapse');
            // tmp.firstElementChild.lastElementChild.classList.add('in');
            tmp.firstElementChild.lastElementChild.setAttribute('id','collapseOptions');
            tmp.firstElementChild.lastElementChild.setAttribute('aria-expanded',"false");
            tmp.firstElementChild.lastElementChild.setAttribute('style',"height: 0px;");
            tmp.firstElementChild.lastElementChild.appendChild( document.createElement('div'));
            tmp.firstElementChild.lastElementChild.firstElementChild.classList.add('panel-body');
            var optionForm = document.createElement('form');
            tmp.firstElementChild.lastElementChild.firstElementChild.appendChild(optionForm);
            optionForm.setAttribute('role','form');
            optionForm.appendChild( document.createElement('div'));
            optionForm.firstElementChild.classList.add('form-group');
            optionForm.firstElementChild.appendChild( document.createElement('label'));
            optionForm.firstElementChild.lastElementChild.setAttribute('for', 'step');
            optionForm.firstElementChild.lastElementChild.textContent = 'шаг';
            optionForm.firstElementChild.appendChild( document.createElement('input'));
            optionForm.firstElementChild.lastElementChild.setAttribute('id','step');
            optionForm.firstElementChild.lastElementChild.value = step;
            optionForm.firstElementChild.lastElementChild.classList.add('form-control');

            optionForm.firstElementChild.appendChild( document.createElement('label'));
            optionForm.firstElementChild.lastElementChild.setAttribute('for', 'min');
            optionForm.firstElementChild.lastElementChild.textContent = 'минимум';
            optionForm.firstElementChild.appendChild( document.createElement('input'));
            optionForm.firstElementChild.lastElementChild.setAttribute('id','min');
            optionForm.firstElementChild.lastElementChild.value = min;
            optionForm.firstElementChild.lastElementChild.classList.add('form-control');

            optionForm.firstElementChild.appendChild( document.createElement('label'));
            optionForm.firstElementChild.lastElementChild.setAttribute('for', 'max');
            optionForm.firstElementChild.lastElementChild.textContent = 'максимум';
            optionForm.firstElementChild.appendChild( document.createElement('input'));
            optionForm.firstElementChild.lastElementChild.setAttribute('id','max');
            optionForm.firstElementChild.lastElementChild.value = max;
            optionForm.firstElementChild.lastElementChild.classList.add('form-control');

            // optionForm.firstElementChild.appendChild( document.createElement('label'));// как разделитель
            optionForm.firstElementChild.appendChild( document.createElement('button'));
            optionForm.firstElementChild.lastElementChild.setAttribute('type','button');
            optionForm.firstElementChild.lastElementChild.classList.add('col-lg-12');
            optionForm.firstElementChild.lastElementChild.setAttribute('style','margin-top: 10px;');
            optionForm.firstElementChild.lastElementChild.innerHTML = 'OK';
            optionForm.firstElementChild.lastElementChild.onclick = function () {
                var x = document.getElementById('step');
                if ( x.value !== '' ) step = parseInt(x.value);
                x = document.getElementById('min');
                if ( x.value !== '' ) min = parseInt(x.value);
                x = document.getElementById('max');
                if ( x.value !== '' ) max = parseInt(x.value);
            };
        container.appendChild(tmp);
        ////// конец свёртка


        // tmp = document.createElement('button');
        // tmp.setAttribute('type', 'button');
        // tmp.innerHTML = '?';
        // tmp.onclick = function () {
        // };



        console.log(container);
        console.log(nodeElement);
        nodeElement.parentNode.insertBefore(container, nodeElement.nextSibling); // типа nodeElement.insertAfter()
    }
}

function LiveEdit(nodeElement) {
    // nodeElement.
    // nodeElement.preventDefault();
    // nodeElement.hidden = true;

    var newNode = document.createElement('div');
    newNode.appendChild( document.createElement('form'));
    newNode.firstElementChild.setAttribute( 'role', 'form'); // для красоты от bootstrap
    newNode.firstElementChild.appendChild( document.createElement('div') ); // для красоты от bootstrap
    newNode.firstElementChild.firstElementChild.classList.add('form-group'); // для красоты от bootstrap
    var textarea = document.createElement('textarea');
    newNode.firstElementChild.firstElementChild.appendChild( textarea );
    textarea.value = nodeElement.innerHTML;
    var btn = document.createElement('button');
    newNode.firstElementChild.firstElementChild.appendChild( btn );
    btn.innerHTML = 'Применить';
    btn.setAttribute( 'type', 'button' );
    btn.onclick = function (button) {
        nodeElement.innerHTML = textarea.value;
        nodeElement.hidden = false;
        newNode.remove();
    };

}


nodeElement = document.querySelectorAll('h1');
console.log(nodeElement);
for ( var i=0; i<nodeElement.length; i++)
{
    // короч я тут запутался что куда я хочу и как это сделать
    nodeElement[0].onclick = LiveEdit(nodeElement);
}

var nodeElement = document.getElementById('numberbox');
// var nodeElement = document.getElementsByTagName('h1');
var field =new CounterField(nodeElement, 3, 0, 30 );
field.inition();

 // console.log(field);