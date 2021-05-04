import Scroll from "./Scroll";
import {useContext, useEffect, useState} from "react";
import {AppContext} from "../AppContext";
import Loading from "./Loading";
import {LIMIT_MESSAGES_CHAT, SOCKET} from "../Constants";
import {setChat, setChatBoxLoading, updateAlert} from "../actions";
import {InertiaLink, usePage} from "@inertiajs/inertia-react";
import Dropdown from "./Dropdown";
import Permissions from "./Permissions";
import UsersSelectComponent from "./UsersSelectComponent";
import PrimaryButton from "./PrimaryButton";
import Service from "../Service";
import {Message, successAlert} from "../helpers";
import Emoji from "./Emoji";
import ChatInputFile from "./ChatInputFile";

const ChatBox = ({setRefreshList}) => {
    const {data:{chatItem}} = useContext(AppContext);
    return (
        <div className="card card-custom">

            {!chatItem
            ? <NoChat />
            : (
                <>
                    <ChatBoxHeader setRefreshList={setRefreshList} />

                    <ChatBoxBody />

                    <ChatBoxFooter />
                </>
                )
            }

        </div>
    );
}

const ChatBoxHeader = (({setRefreshList}) => {
    const {data:{chatItem, onlineUsers}} = useContext(AppContext);
    return (
        <div className="card-header d-flex justify-content-between px-4 py-3">
            <div className='d-flex justify-content-start'>
                <div className='symbol symbol-circle symbol-40 mr-3 symbol-light-success'>
                    {chatItem.isUser && <span className={'label label-lg label-dot online-label ' + (onlineUsers.includes(chatItem.id) ? 'is-online' : 'is-offline')}></span>}
                    {chatItem.imageComponent}
                </div>
                <div className="text-dark-75 font-weight-bold font-size-h5">
                    <span className='d-block text-capitalize'>{chatItem.title}</span>
                    <span className='d-block text-muted font-weight-bold font-size-sm'>{chatItem.subTitle}</span>
                    <span className='d-block text-muted font-weight-bold font-size-sm'>{chatItem.span}</span>
                </div>
            </div>
            {chatItem.isGroup &&
            <div className="dropdown dropdown-inline align-self-center">
                <Dropdown>
                    <GroupMenu setRefreshList={setRefreshList} group={chatItem} />
                </Dropdown>
            </div>
            }
        </div>
    )
})

const ChatBoxBody = (() => {
    const {auth: {user_id}} = usePage().props;
    const {data:{chatItem, chatBoxLoading}, dispatch} = useContext(AppContext);
    const [page, setPage] = useState(1);
    const [hiddenPaginate, setHiddenPaginate] = useState(true);
    const [autoBottom, setAutoBottom] = useState(true);

    /**
     * Load More Messages
     */
    const loadMoreMessages = (e) => {
        e.preventDefault();
        //increment page paginate
        let incPage = (page + 1);
        setPage(incPage);
        //off scroll auto bottom when load more messages
        setAutoBottom(false);
        //set loading
        dispatch(setChatBoxLoading(true));
        //load more messages request
        let url = chatItem.messagesUrl + '&page_messages=' + incPage;
        Service.getMessages(url)
            .then((r) => {
                let item = chatItem;
                const {data:{messages}} = r;
                if (messages.length == 0) {
                    setHiddenPaginate(true);
                }else {
                    let msgs = [];
                    messages.forEach((msg) => {
                        msgs.push(new Message(msg, user_id));
                    });
                    dispatch(setChat({...item, chat: msgs}));
                }
            })
            .finally(() => dispatch(setChatBoxLoading(false)));
    }

    //Hidden loadmore! link if chat length less than limit
    useEffect(() => {
        setHiddenPaginate((chatItem?.chat.length !== LIMIT_MESSAGES_CHAT));
    }, [chatItem])

    return (
        <div className="card-body" style={{padding: '2rem 1rem'}}>
            <Scroll height={280} autoBottom={autoBottom}>
                <div className="messages">

                    {chatBoxLoading
                        ? <Loading />
                        : (
                            chatItem.chat.length == 0 ? <small className='font-weight-bold text-muted text-center d-block font-size-h6'>Start Chat!</small>
                                : <>
                                    {
                                        (!hiddenPaginate) ? <a onClick={loadMoreMessages} href='#' className='d-block text-center py-3'>load more!</a> : ''
                                    }
                                    {
                                        chatItem.chat.map((message, i) => (
                                            <div key={i} className={"d-flex mb-1 " + (message.myMessage ? 'flex-column align-items-end' : 'align-items-start')}>
                                                <div className="d-flex align-self-end">
                                                    {!message.myMessage
                                                        ? <>
                                                            <div className="symbol symbol-circle symbol-30 mr-2">
                                                                <img className='cursor-pointer' alt={message.user_name} title={message.user_name} src={message.user_avatar} />
                                                            </div>
                                                        </>
                                                        : ''
                                                    }
                                                </div>
                                                <div title={message.created_at} className={"mt-1 rounded p-3 font-weight-bold font-size-lg text-left max-w-400px text-dark-50 " + (message.myMessage ? 'bg-light-primary' : 'bg-light-success')}>
                                                    {message.isText ? message.message_content : <div className="symbol"><img className='img-message' alt={message.original_name} src={message.file_path}/></div>}
                                                </div>
                                            </div>
                                        ))
                                    }
                                </>
                        )
                    }

                </div>
            </Scroll>
        </div>
    )
})

const ChatBoxFooter = (() => {
    const {data:{chatItem}} = useContext(AppContext);
    const [toggleEmoji, setToggleEmoji] = useState(false);
    const [text, setText] = useState('');
    const [images, setImages] = useState([]);

    const handleToggleEmoji = () => setToggleEmoji(!toggleEmoji);

    const handleChangeTextarea = (e) => {
        setText(e.target.value);
    }

    const onImageRemove = (index) => {
        let imgs = [...images];
        imgs.splice(index, 1);
        setImages(imgs);
    }

    const handleChangeEmojiSelect = (emoji) => {
        let txt = text + emoji.native;
        setText(txt);
    }

    const handleSendMessage = () => {
        if (text != '') {
            let textData = {text: text, [chatItem.identify]: chatItem.id};
            SOCKET.emit('message', textData);
        }
        if (images.length) {
            let files = images.map((image) => {
                return {
                    name: image.file.name,
                    base64: image.data_url
                };
            });
            let imagesData = {[chatItem.identify]: chatItem.id, files: files};
            SOCKET.emit('message_files', imagesData);
        }
        setText('');
        setImages([]);
    }

    return (
        <div className="card-footer align-items-center" style={{padding: '1rem 2.25rem'}}>
            {images.length ? <div className='container-chat-images'>
                <div className="symbol-list d-flex flex-wrap">
                    {images.map((image, index) => (
                        <div key={index} className="symbol mr-3">
                            <img src={image.data_url}/>
                            <button
                                className='symbol-badge bg-danger btn btn-icon btn-sm as-a no-underline-hover cancel-chat-image'
                                onClick={() => onImageRemove(index)}
                            >
                                <i className="flaticon2-cancel-music icon-sm"></i>
                            </button>
                        </div>
                    ))}
                </div>
            </div> : ''}
            <textarea
                style={{minHeight: 40}}
                onChange={handleChangeTextarea}
                onKeyDown={(e) => {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        handleSendMessage();
                    }
                }}
                value={text}
                className="form-control border-0 p-0"
                rows="2"
                placeholder="Aa"
            ></textarea>
            <div className="d-flex align-items-center justify-content-between mt-5">
            <div className="mr-3">
                <ChatInputFile images={images} onChange={(imagesList) => setImages(imagesList)} />
                <button onClick={handleToggleEmoji} className="btn btn-clean btn-icon btn-md as-a no-underline-hover">
                    <i className="far fa-laugh icon-lg"></i>
                </button>
                {toggleEmoji && <Emoji onSelect={handleChangeEmojiSelect} />}
            </div>
            <div>
                <PrimaryButton onClick={handleSendMessage}>Send</PrimaryButton>
            </div>
        </div>
        </div>
)})

const NoChat = () => {
    return <div className='card-body'><p className='text-muted font-weight-bold text-lg'>Please Select User!</p></div>;
}

const GroupMenu = ({group, setRefreshList}) => {
    const {dispatch} = useContext(AppContext);
    const [openJoinMembers, setOpenJoinMembers] = useState(false);
    const [processing, setProcessing] = useState(false);
    const [users, setUsers] = useState([]);
    const [members, setMembers] = useState([]);
    const user_token = window.USER_TOKEN;

    const handleJoinMembersClick = (e) => {
        e.preventDefault();
        let newOpenStatus = !openJoinMembers;
        setOpenJoinMembers(newOpenStatus);
        if (newOpenStatus) {
            if (users.length == 0) {
                //send api request for get all users only once
                Service.getAllMembers(user_token).then(({data}) => {setUsers(data.members);})
            }
            Service.getSpecificMembers(user_token, group.id)
                .then(({data}) => {
                    let members = [];
                    data.members.forEach(v => {
                        members.push(v.user_id)
                    });
                    setMembers(members);
                })
        }
    }

    const handleJoinMembersUpdateClick = (e) => {
        e.preventDefault()
        setProcessing(true);
        Service.updateGroup(user_token, group.id, {members}).then(r => {
            setOpenJoinMembers(false);
            dispatch(updateAlert(successAlert))
        }).finally(() => setProcessing(false))
    }

    const handleDeleteGroupClick = () => {
        Service.deleteGroup(user_token, group.id).finally(() => {
            dispatch(setChat(null))
            setRefreshList((r) => !r);
            dispatch(updateAlert(successAlert))
        })
    }

    return (
       <ul className="navi navi-hover py-5">

           <Permissions hasPermissions={['chat_groups-browse']}>
               <li className="navi-item">
                   <InertiaLink className="navi-link" href={route('dashboard.chat_groups.index')}>
                       <span className="navi-icon"><i className="flaticon2-drop"></i></span>
                       <span className="navi-text">{translations['add'] +' '+ translations['group']}</span>
                   </InertiaLink>
               </li>
           </Permissions>

           {group.isMyGroup &&
            <li className="navi-item">
               <a href="#" onClick={handleJoinMembersClick} className="navi-link">
                   <span className="navi-icon"><i className="flaticon2-rocket-1"></i></span>
                   <span className="navi-text">{translations['join_members']}</span>
               </a>
                {openJoinMembers &&
                <div className='card card-custom shadow-none'>
                    <div className='card-body'>
                        <UsersSelectComponent
                            onChange={(value, { action, removedValue }) => {
                                let ids = value.map(v => v.user_id);
                                setMembers(ids)
                            }}
                            options={users}
                            value={users.filter(user => members.includes(user.user_id))}
                        />

                        <PrimaryButton
                            classes={'mt-5' + (processing ? ' spinner spinner-white spinner-left spinner-sm' : '')}
                            disabled={processing}
                            onClick={handleJoinMembersUpdateClick}
                        >
                            {translations['save']}
                        </PrimaryButton>
                    </div>
                </div>
                }
           </li>
           }

           <li className="navi-separator my-3"></li>

           {group.isMyGroup ?
               (<li className="navi-item">
                   <a
                       href="#"
                       className="navi-link bg-hover-danger-o-1"
                       onClick={handleDeleteGroupClick}
                   >
                       <span className="navi-icon"><i className="flaticon2-trash"></i></span>
                       <span className="navi-text">{translations['delete']}</span>
                   </a>
               </li>) :
               (
                   <li className="navi-item">
                       <a href="#" className="navi-link bg-hover-danger-o-1">
                           <span className="navi-icon"><i className="flaticon2-trash"></i></span>
                           <span className="navi-text">{translations['leave_group']}</span>
                       </a>
                   </li>
               )
           }

       </ul>
   );
}

export default ChatBox;
