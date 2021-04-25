export const formBuilder = (languages, formInputs={}, translatableInputs=[]) => {
    let keys = Object.keys(formInputs);
    let formBuilder = {};
    keys.map((input) => {
        if (!translatableInputs.includes(input)) {
            formBuilder[input] = formInputs[input];
        }else {
            formBuilder[input] = {};
            languages.map((lang) => {
                formBuilder[input][lang.language_code] = formInputs[input];
            });
        }
    })
    return formBuilder;
}

export const getLanguagesTabs = (languages) => {
    const tabs = languages.map((lang) => {
        return {id: lang.language_code, title: lang.language_name};
    });

    return tabs;
}

export const getFromObject = (obj, el, defaultValue='') => {
    return myIf(obj, el, obj[el], defaultValue)
}

export const myIf = (obj, el, trueValue, falseValue) => {
    return obj[el] ? trueValue : falseValue;
}

export const handleOptions = (options) => {
    let ops = {};
    options.map((option) => {
        ops[option.option_key] = option.option_value;
    })
    return ops;
}

export const assets = (url) => {
    return `/storage/${url}`;
}

export const isTrue = (value) => {
    if (typeof(value) === 'string'){
        value = value.trim().toLowerCase();
    }
    switch(value){
        case true:
        case "true":
        case 1:
        case "1":
        case "on":
        case "yes":
            return true;
        default:
            return false;
    }
}

export const generateSlug = (text) => {
    return text.toLowerCase().replace(/([^أ-يA-Za-z0-9]|-)+/g,'-').replace(/ +/g,'-');
}

export const isEmptyObject = (object) => {
    return Object.keys(object).length == 0;
}

export const getParents = (el, parentSelector) => {
    var parents = [];
    var p = el?.parentNode;
    while (p) {
        if (p == document) break;
        if (p.classList.contains(parentSelector)) {
            parents.push(p);
        }
        p = p.parentNode;
    }
    return parents;
}

export class ChatItem {
    constructor(item) {
        this.model_type = item.model_type;
        this.title = '';
        this.subTitle = '';
        this.imageComponent = '';
        this.text = '';
        this.chatUrl = '';
        this.chat = [];

        switch (item.model_type) {
            case 'user' :
                this.title = item.user_name;
                this.subTitle = item.name + ' / ' + item.user_email;
                this.text = '25 mins';
                this.imageComponent = <img alt={this.title} src={assets(item.user_avatar)}/>;
                break;
            case 'group' :
                this.title = item.group_name;
                this.subTitle = translations['group'] || 'group';
                this.imageComponent = <span className={'symbol-label font-size-h5 font-weight-bold text-uppercase'}>{this.title[0]}</span>;
                break
        }
    }


}
