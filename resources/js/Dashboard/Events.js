import Hooks from "../Common/Hooks";
import {setChat, setNewMessagesCount} from "./actions";

export default class Events {
    static run() {
        Hooks.add_action('new_message', Events.newMessage);
    }

    static newMessage(message, data, dispatch) {
        const {newMessagesCount, chatItem} = data;
        if (!message.myMessage) {
            dispatch(setNewMessagesCount((newMessagesCount+1)));
        }
        if (chatItem) {
            if ((chatItem.isGroup && message.group_id == chatItem.id)
                ||
                (chatItem.isUser && message.user_id == chatItem.id)
                ||
                (chatItem.isUser && message.reciever_id == chatItem.id)
            ) {
                dispatch(setChat({...chatItem, chat: [...chatItem.chat, message]}));
            }
        }
    }
}
