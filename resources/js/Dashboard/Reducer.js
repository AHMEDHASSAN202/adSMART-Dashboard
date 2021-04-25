import {
    ALL_CHECKED,
    PAGE_LOADING,
    SECTION_LOADING,
    ADD_LANGUAGE,
    UPDATE_TRANSLATE,
    TOGGLE_PROFILE_PANEL,
    CURRENT_URL, SET_LANGUAGES, UPDATE_ALERT, SET_CURRENT_USER, SET_PAGE_PROPS, SET_SOCKET, SET_USERS_GROUPS, SET_CHAT
} from "./actions";

export const Reducer = (state, action) => {
    switch (action.TYPE) {
        case ALL_CHECKED:
            return {...state, all_checked: action.payload}
        case PAGE_LOADING:
            return {...state, pageLoading: action.payload}
        case SECTION_LOADING:
            return {...state, sectionLoading: action.payload}
        case ADD_LANGUAGE:
            let langs = state.languages;
            langs.push(action.payload);
            return {...state, languages: langs}
        case UPDATE_TRANSLATE:
            let translations = state.translations;
            let {d, languageCode, update} = action.payload;
            translations[d][languageCode] = update;
            return {...state, translations};
        case TOGGLE_PROFILE_PANEL:
            return {...state, openProfilePanel: action.payload};
        case CURRENT_URL:
            return {...state, currentUrl: action.payload}
        case SET_LANGUAGES:
            return {...state, languages: action.payload}
        case UPDATE_ALERT:
            let props = state.props;
            props.alert = action.payload;
            return {...state, props: props}
        case SET_CURRENT_USER:
            return {...state, auth: action.payload}
        case SET_PAGE_PROPS:
            return {...state, props: action.payload}
        case SET_SOCKET:
            return {...state, socket: action.payload}
        case SET_USERS_GROUPS:
            return {...state, usersGroups: action.payload}
        case SET_CHAT:
            return {...state, chat: action.payload}
        default:
            return state;
    }
}
