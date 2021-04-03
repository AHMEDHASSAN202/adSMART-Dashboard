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
