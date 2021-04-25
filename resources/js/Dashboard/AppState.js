//initial app state
export const AppState = {
    pageLoading: false,
    initialData: window.initialData,
    openProfilePanel: false,
    currentUrl: window.location.href,
    languages: window.languages,
    socket: null,
    usersGroups: [],
    chat: {message: [], user: {}}
};
