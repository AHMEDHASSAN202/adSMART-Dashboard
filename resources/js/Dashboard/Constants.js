export const PaginationPerPageDefault = 10;
export const WebSocketServer = 'ws://127.0.0.1:1215';
export const WebSocketServerOptions = {
    withCredentials: true,
    transports: ['websocket'],
    path: '/socket.io',
};

export const GET_USERS_AND_GROUPS_URL = window.WS_SERVICE_DOMAIN + 'chat/get-users-and-groups';
export const GET_MESSAGES_CHAT_URL = window.WS_SERVICE_DOMAIN + 'chat/get-messages';
export const GROUPS_URL = window.WS_SERVICE_DOMAIN + 'groups';
export const LIMIT_MESSAGES_CHAT = 100;
