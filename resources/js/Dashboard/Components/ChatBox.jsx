import Scroll from "./Scroll";
import {useContext, useEffect, useState} from "react";
import {AppContext} from "../AppContext";
import Loading from "./Loading";
import {LIMIT_MESSAGES_CHAT} from "../Constants";
import {setChat, setChatBoxLoading} from "../actions";
import {InertiaLink, usePage} from "@inertiajs/inertia-react";
import Dropdown from "./Dropdown";
import Permissions from "./Permissions";
import UsersSelectComponent from "./UsersSelectComponent";
import PrimaryButton from "./PrimaryButton";
import Service from "../Service";

const ChatBox = ({setRefreshList}) => {
    const {auth: {user_token, user_id}} = usePage().props;
    const {data:{chatItem, onlineUsers, chatBoxLoading}, dispatch} = useContext(AppContext);
    const [page, setPage] = useState(1);
    const [hiddenPaginate, setHiddenPaginate] = useState(true);
    const [autoBottom, setAutoBottom] = useState(true);

    /**
     * Load More Messages
     *
     * @param e
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
                    }
                    let mergeMessages = [ ...messages, ...item.chat]
                    item.setMessages(mergeMessages, user_id);
                    dispatch(setChat(item));
                })
                .finally(() => dispatch(setChatBoxLoading(false)));
    }

    //Hidden loadmore! link if chat length less than limit
    useEffect(() => {
        setHiddenPaginate((chatItem?.chat.length !== LIMIT_MESSAGES_CHAT));
    }, [chatItem])

    return (
        <div className="card card-custom">

            {!chatItem
            ? <NoChat />
            : (
                <>
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
                                    <GroupMenu setRefreshList={setRefreshList} user_token={user_token} group={chatItem} />
                                </Dropdown>
                            </div>
                        }
                    </div>

                    <div className="card-body" style={{padding: '2rem 1rem'}}>
                        <Scroll height={280} autoBottom={autoBottom}>
                            <div className="messages">

                                {chatBoxLoading
                                    ? <Loading />
                                    : (
                                        <>
                                            {
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
                                                                        {message.message_content}
                                                                    </div>
                                                                </div>
                                                            ))
                                                        }
                                                  </>
                                            }
                                        </>
                                    )
                                }

                            </div>
                        </Scroll>
                    </div>

                    <div className="card-footer align-items-center" style={{padding: '1rem 2.25rem'}}>
                        <textarea className="form-control border-0 p-0" rows="2" placeholder="Type a message"></textarea>
                        <div className="d-flex align-items-center justify-content-between mt-5">
                            <div className="mr-3">
                                <a href="#" className="btn btn-clean btn-icon btn-md mr-1"><i
                                    className="flaticon2-photograph icon-lg"></i></a>
                                <a href="#" className="btn btn-clean btn-icon btn-md"><i
                                    className="flaticon2-photo-camera  icon-lg"></i></a>
                            </div>
                            <div>
                                <button type="button"
                                        className="btn btn-primary btn-md text-uppercase font-weight-bold chat-send py-2 px-6">Send
                                </button>
                            </div>
                        </div>
                    </div>
                </>
                )
            }

        </div>
    );
}

const NoChat = () => {
    return <div className='card-body'><p className='text-muted font-weight-bold text-lg'>Please Select User!</p></div>;
}

const GroupMenu = ({user_token, group, setRefreshList}) => {
    const {dispatch} = useContext(AppContext);
    const [openJoinMembers, setOpenJoinMembers] = useState(false);
    const [processing, setProcessing] = useState(false);
    const [users, setUsers] = useState([]);
    const [members, setMembers] = useState([]);

    const handleJoinMembersClick = (e) => {
        e.preventDefault();
        setOpenJoinMembers(!openJoinMembers);
    }

    const handleJoinMembersUpdateClick = (e) => {
        e.preventDefault()
        setProcessing(true);
        Service.updateGroup(user_token, group.id, {members}).then(r => {setProcessing(false); setOpenJoinMembers(false)})
    }

    const handleDeleteGroupClick = () => {
        Service.deleteGroup(user_token, group.id).finally(() => {
            dispatch(setChat(null))
            setRefreshList(Math.random() * 100);
        })
    }

    useEffect(() => {
        Service.getAllMembers(user_token).then(({data}) => {setUsers(data.members);})
    } , [])

    useEffect(() => {
        Service.getSpecificMembers(user_token, group.id)
                .then(({data}) => {
                    let members = [];
                    data.members.forEach(v => {
                        members.push(v.user_id)
                    });
                    setMembers(members);
                })
    } , [group])

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
