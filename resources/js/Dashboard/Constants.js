export const PaginationPerPageDefault = 10;
export const WebSocketServer = 'ws://127.0.0.1:1215';
export const WebSocketServerOptions = {
    withCredentials: true,
    transports: ['websocket'],
    path: '/socket.io',
};
export const GET_USERS_AND_GROUPS_URL = window.WS_SERVICE_DOMAIN + 'chat/get-users-and-groups';
