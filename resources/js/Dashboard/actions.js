import {ChatItem} from "./helpers";
export const ALL_CHECKED = "ALL_CHECKED";
export const PAGE_LOADING = "PAGE_LOADING";
export const SECTION_LOADING = "SECTION_LOADING";
export const ADD_LANGUAGE = 'ADD_LANGUAGE';
export const UPDATE_TRANSLATE = 'UPDATE_TRANSLATE';
export const TOGGLE_PROFILE_PANEL = 'TOGGLE_PROFILE_PANEL';
export const CURRENT_URL = 'CURRENT_URL';
export const SET_LANGUAGES = 'SET_LANGUAGES';
export const UPDATE_ALERT = 'UPDATE_ALERT';
export const SET_CURRENT_USER = 'SET_CURRENT_USER';
export const SET_PAGE_PROPS = 'SET_PAGE_PROPS';
export const SET_SOCKET = 'SET_SOCKET';
export const SET_USERS_GROUPS = 'SET_USERS_GROUPS';
export const SET_CHAT = 'SET_CHAT';
export const SET_CHAT_BOX_LOADING = 'SET_CHAT_BOX_LOADING';
export const SET_ONLINE_USERS = 'SET_ONLINE_USERS';
export const SET_NEW_MESSAGES_COUNT = 'SET_NEW_MESSAGES_COUNT';

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

export function setUser(payload) {
    return {
        TYPE: SET_CURRENT_USER,
        payload: payload
    }
}

export function setPageProps(payload) {
    if (payload.reload) {
        window.location.reload();
    }
    return {
        TYPE: SET_PAGE_PROPS,
        payload: payload
    }
}

export function setChat(chat) {
    return {
        TYPE: SET_CHAT,
        payload: chat
    }
}

export function setChatBoxLoading(s) {
    return {
        TYPE: SET_CHAT_BOX_LOADING,
        payload: s
    }
}

export function setOnlineUsers(users) {
    return {
        TYPE: SET_ONLINE_USERS,
        payload: users
    }
}

export function setNewMessagesCount(payload) {
    return {
        TYPE: SET_NEW_MESSAGES_COUNT,
        payload: payload
    }
}
