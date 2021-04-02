export const ALL_CHECKED = "ALL_CHECKED";
export const PAGE_LOADING = "PAGE_LOADING";
export const SECTION_LOADING = "SECTION_LOADING";
export const ADD_LANGUAGE = 'ADD_LANGUAGE';
export const UPDATE_TRANSLATE = 'UPDATE_TRANSLATE';
export const TOGGLE_PROFILE_PANEL = 'TOGGLE_PROFILE_PANEL';
export const CURRENT_URL = 'CURRENT_URL';
export const SET_LANGUAGES = 'SET_LANGUAGES';
export const UPDATE_ALERT = 'UPDATE_ALERT';

export function pageLoader(status) {
  return {
      TYPE: PAGE_LOADING,
      payload: status
    }
}

export function sectionLoader(status) {
    return {
        TYPE: SECTION_LOADING,
        payload: status
      }
}

export function updateTranslate(payload) {
    return {
        TYPE: UPDATE_TRANSLATE,
        payload: payload
      }
}

export function toggleProfilePanel(payload) {
    return {
        TYPE: TOGGLE_PROFILE_PANEL,
        payload: payload
    }
}

export function currentUrl(payload) {
    return {
        TYPE: CURRENT_URL,
        payload: payload
    }
}

export function setLanguages(payload) {
    return {
        TYPE: SET_LANGUAGES,
        payload: payload
    }
}

export function updateAlert(payload) {
    return {
        TYPE: UPDATE_ALERT,
        payload: payload
    }
}

