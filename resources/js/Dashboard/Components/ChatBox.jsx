import Scroll from "./Scroll";
import {useContext} from "react";
import {AppContext} from "../AppContext";
import Loading from "./Loading";

const ChatBox = () => {
    const {data:{chatItem, chatBoxLoading}} = useContext(AppContext);
    return (
        <div className="card card-custom">

            {!chatItem
            ? <NoChat />
            : (
                <>
                    <div className="card-header align-items-center px-4 py-3">
                        <div className="text-center flex-grow-1">
                            <div className="text-dark-75 font-weight-bold font-size-h5 text-capitalize">{chatItem.title}</div>
                            <small className="text-muted font-weight-bold ">{chatItem.subTitle}</small>
                            <div>
                                <span className="label label-sm label-dot label-success"></span>
                                <span className="font-weight-bold text-muted font-size-sm">Active</span>
                            </div>
                        </div>
                    </div>

                    <div className="card-body">
                        <Scroll height={280}>
                            <div className="messages px-3">

                                {chatBoxLoading
                                    ? <Loading />
                                    : (
                                        <>
                                            {
                                                chatItem.length == 0
                                                ? <small>start chat</small>
                                                : (
                                                        chatItem.chat.map((message, i) => (
                                                            <div key={i} className={"d-flex flex-column mb-5 " + (message.myMessage ? 'align-items-end' : 'align-items-start')}>
                                                                <div className="d-flex align-items-center">
                                                                    {!message.myMessage
                                                                        ? <>
                                                                            <div className="symbol symbol-circle symbol-40">
                                                                                <img alt={message.user_name} src={message.user_avatar} />
                                                                            </div>
                                                                            <div className='mx-3'>
                                                                                <a href="#" className="text-dark-75 text-hover-primary font-weight-bold font-size-h6 text-capitalize"> {message.user_name} </a>
                                                                                <span className="text-muted font-size-sm mx-1">{message.created_at}</span>
                                                                            </div>
                                                                        </>
                                                                        : <>
                                                                            <div className='mx-3'>
                                                                                <span className="text-muted font-size-sm mx-1">{message.created_at}</span>
                                                                                <a href="#" className="text-dark-75 text-hover-primary font-weight-bold font-size-h6 text-capitalize"> {message.user_name} </a>
                                                                            </div>
                                                                            <div className="symbol symbol-circle symbol-40">
                                                                                <img alt={message.user_name} src={message.user_avatar} />
                                                                            </div>
                                                                        </>
                                                                    }
                                                                </div>
                                                                <div className={"mt-1 rounded p-3 font-weight-bold font-size-lg text-left max-w-400px text-dark-50 " + (message.myMessage ? 'bg-light-primary' : 'bg-light-success')}>
                                                                    {message.message_content}
                                                                </div>
                                                            </div>
                                                        ))
                                                    )
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

export default ChatBox;
