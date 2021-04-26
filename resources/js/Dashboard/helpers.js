import {GET_MESSAGES_CHAT_URL} from "./Constants";

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

function timeSinceFromNow(date) {

    if (date == '' || date == null) return '';

    let seconds = Math.floor((new Date() - date) / 1000);

    let interval = seconds / 31536000;
    if (interval > 1) {
        return Math.floor(interval) + " years";
    }

    interval = seconds / 2592000;
    if (interval > 1) {
        return Math.floor(interval) + " months";
    }

    interval = seconds / 86400;
    if (interval > 1) {
        return Math.floor(interval) + " days";
    }

    interval = seconds / 3600;
    if (interval > 1) {
        return Math.floor(interval) + " hours";
    }

    interval = seconds / 60;
    if (interval > 1) {
        return Math.floor(interval) + " minutes";
    }

    return Math.floor(seconds) + " seconds";
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
    constructor(item, auth) {
        this.model_type = item.model_type;
        this.title = '';
        this.subTitle = '';
        this.imageComponent = '';
        this.text = '';
        this.chatUrl = '';
        this.chat = [];
        this.messagesUrl = '';

        switch (item.model_type) {
            case 'user' :
                this.title = item.user_name;
                this.subTitle = item.name + ' / ' + item.user_email;
                this.imageComponent = <img alt={this.title} src={assets(item.user_avatar)}/>;
                this.messagesUrl = GET_MESSAGES_CHAT_URL + '?auth_token=' + auth.user_token + '&lang=' + currentLanguage.language_id + '&user_id=' + item.user_id;
                break;
            case 'group' :
                this.title = item.group_name;
                this.subTitle = translations['group'] || 'group';
                this.imageComponent = <span className={'symbol-label font-size-h5 font-weight-bold text-uppercase'}>{this.title[0]}</span>;
                this.messagesUrl = GET_MESSAGES_CHAT_URL + '?auth_token=' + auth.user_token + '&lang=' + currentLanguage.language_id + '&group_id=' + item.group_id;
                break
        }

        let lastMessage = new Message(item, auth.user_id);
        this.text = lastMessage.created_at;
        this.chat.push(lastMessage);
    }

    getLastMessage(prop) {
        if (this.chat.length == 0) return '';
        return prop ? this.chat[(this.chat.length-1)][prop] : this.chat[(this.chat.length-1)];
    }

    setMessages(messages=[], auth_id) {
        let msgs = [];
        messages.forEach((msg) => msgs.push(new Message(msg, auth_id)));
        this.chat = msgs;
    }
}

export class Message {
    constructor(message, auth_id) {
        this.message_id = message.message_id || '';
        this.message_type = message.message_type || 'text';
        this.message_content = message.message_content || '';
        this.created_at = message.created_at ? timeSinceFromNow(new Date(message.created_at)) : '';
        this.file_id = '';
        this.file_path = '';
        this.original_name = '';
        this.user_id = message.user_id || '';
        this.user_name = message.user_name || '';
        this.user_avatar = message.user_avatar ? assets(message.user_avatar) : '';
        this.myMessage = (this.user_id === auth_id);
        if (this.message_type != 'text') {
            this.file_id = message.file_id || '';
            this.file_path = assets(message.file_path) || '';
            this.original_name = message.original_name || '';
            this.message_content = this.original_name;
        }
    }
}
