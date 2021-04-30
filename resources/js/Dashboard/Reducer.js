import {
    ALL_CHECKED,
    PAGE_LOADING,
    SECTION_LOADING,
    ADD_LANGUAGE,
    UPDATE_TRANSLATE,
    TOGGLE_PROFILE_PANEL,
    CURRENT_URL,
    SET_LANGUAGES,
    UPDATE_ALERT,
    SET_CURRENT_USER,
    SET_PAGE_PROPS,
    SET_SOCKET,
    SET_USERS_GROUPS,
    SET_CHAT,
    SET_CHAT_BOX_LOADING, SET_ONLINE_USERS, SET_NEW_MESSAGES_COUNT
} from "./actions";

export const Reducer = (state, action) => {
    switch (action.TYPE) {
        case PAGE_LOADING:
            return {...state, pageLoading: action.payload}
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
        case SET_CHAT:
            return {...state, chatItem: action.payload}
        case SET_CHAT_BOX_LOADING:
            return {...state, chatBoxLoading: action.payload}
        case SET_ONLINE_USERS:
            return {...state, onlineUsers: action.payload}
        case UPDATE_ALERT:
            return {...state, clientAlert: action.payload};
        case SET_NEW_MESSAGES_COUNT:
            return {...state, newMessagesCount: action.payload};
        default:
            return state;
    }
}
