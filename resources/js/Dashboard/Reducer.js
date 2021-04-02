import {
    ALL_CHECKED,
    PAGE_LOADING,
    SECTION_LOADING,
    ADD_LANGUAGE,
    UPDATE_TRANSLATE,
    TOGGLE_PROFILE_PANEL,
    CURRENT_URL, SET_LANGUAGES, UPDATE_ALERT
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
            return {...state, alert: action.payload}

        default:
            return state;
    }
}
