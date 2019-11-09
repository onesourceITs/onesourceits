/*
    *Name: CreateElement
    *Author: Keith Blackwelder
    *Date: September 1st, 2019
    *Parameters: ("ElementName", "TargetElement", "Position", Attributes:[{}])
    ** ElementName: String, TargetElement: String(css selector"#, ., *, or tagName), 
    ** Position: String(append, prepend, before, after), 
    ** Attributes: Object, [{ 'class': 'container' }]

    *Description: Create a new element for the DOM.
    *Example:
    createElement('div', '#parent', 'after', attributes = [{
        'name': 'id',
        'value': 'childTwo'
    }, {
        'name': 'class',
        'value': 'childTwo'
    }, {
        'name': 'html',
        'value': 'Child Two.'
    }]);

*/

function createElement(tagName, target, position, attributes){
    const targetEl = document.querySelector(target);
    const newEl = document.createElement(tagName);

    const attrObj = attributes;
    if (attrObj.length > 0) {
        attrObj.forEach(prop => {
            if (prop.name != 'html'){
                let newAttr = document.createAttribute(prop.name);
                newAttr.value = prop.value;
                newEl.setAttributeNode(newAttr);
            } else if (prop.name == 'html'){
                newEl.innerHTML = prop.value;
            } else{
                return false;
            }
        });
    }

    if (position == 'append'){
        targetEl.appendChild(newEl);
    } else if (position == 'prepend'){
        targetEl.insertBefore(newEl, targetEl.firstChild);
    } else if (position == 'before'){
        targetEl.parentNode.insertBefore(newEl, targetEl);
    } else {
        targetEl.after(newEl);
        
    }


}

