import Scroll from "./Scroll";

const ChatBox = () => {
    return (
        <div className="card card-custom">

            <div className="card-header align-items-center px-4 py-3">
                <div className="text-center flex-grow-1">
                    <div className="text-dark-75 font-weight-bold font-size-h5">Matt Pears</div>
                    <div>
                        <span className="label label-sm label-dot label-success"></span>
                        <span className="font-weight-bold text-muted font-size-sm">Active</span>
                    </div>
                </div>
            </div>

            <div className="card-body">
                <Scroll height={280}>
                    <div className="messages px-3">

                        <div className="d-flex flex-column mb-5 align-items-start">
                            <div className="d-flex align-items-center">
                                <div className="symbol symbol-circle symbol-40 mr-3">
                                    <img alt="Pic" src="/dashboard-assets/media/users/300_12.jpg"/>
                                </div>
                                <div>
                                    <a href="#"
                                       className="text-dark-75 text-hover-primary font-weight-bold font-size-h6">Matt
                                        Pears</a>
                                    <span className="text-muted font-size-sm">2 Hours</span>
                                </div>
                            </div>
                            <div
                                className="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">
                                How likely are you to recommend our company
                                to your friends and family?
                            </div>
                        </div>

                        <div className="d-flex flex-column mb-5 align-items-end">
                            <div className="d-flex align-items-center">
                                <div>
                                    <span className="text-muted font-size-sm">3 minutes</span>
                                    <a href="#"
                                       className="text-dark-75 text-hover-primary font-weight-bold font-size-h6">You</a>
                                </div>
                                <div className="symbol symbol-circle symbol-40 ml-3">
                                    <img alt="Pic" src="/dashboard-assets/media/users/300_21.jpg"/>
                                </div>
                            </div>
                            <div
                                className="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">
                                Hey there, we’re just writing to let you know
                                that you’ve been subscribed to a repository on GitHub.
                            </div>
                        </div>

                        <div className="d-flex flex-column mb-5 align-items-start">
                            <div className="d-flex align-items-center">
                                <div className="symbol symbol-circle symbol-40 mr-3">
                                    <img alt="Pic" src="/dashboard-assets/media/users/300_21.jpg"/>
                                </div>
                                <div>
                                    <a href="#"
                                       className="text-dark-75 text-hover-primary font-weight-bold font-size-h6">Matt
                                        Pears</a>
                                    <span className="text-muted font-size-sm">40 seconds</span>
                                </div>
                            </div>
                            <div
                                className="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">
                                Ok, Understood!
                            </div>
                        </div>

                        <div className="d-flex flex-column mb-5 align-items-start">
                            <div className="d-flex align-items-center">
                                <div className="symbol symbol-circle symbol-40 mr-3">
                                    <img alt="Pic" src="/dashboard-assets/media/users/300_12.jpg"/>
                                </div>
                                <div>
                                    <a href="#"
                                       className="text-dark-75 text-hover-primary font-weight-bold font-size-h6">Matt
                                        Pears</a>
                                    <span className="text-muted font-size-sm">40 seconds</span>
                                </div>
                            </div>
                            <div
                                className="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">
                                You can unwatch this repository immediately by clicking here: <a
                                href="#">https://github.com</a>
                            </div>
                        </div>

                        <div className="d-flex flex-column mb-5 align-items-end">
                            <div className="d-flex align-items-center">
                                <div>
                                    <span className="text-muted font-size-sm">Just now</span>
                                    <a href="#"
                                       className="text-dark-75 text-hover-primary font-weight-bold font-size-h6">You</a>
                                </div>
                                <div className="symbol symbol-circle symbol-40 ml-3">
                                    <img alt="Pic" src="/dashboard-assets/media/users/300_21.jpg"/>
                                </div>
                            </div>
                            <div
                                className="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">
                                Discover what students who viewed Learn Figma - UI/UX Design. Essential Training also
                                viewed
                            </div>
                        </div>

                        <div className="d-flex flex-column mb-5 align-items-end">
                            <div className="d-flex align-items-center">
                                <div>
                                    <span className="text-muted font-size-sm">Just now</span>
                                    <a href="#"
                                       className="text-dark-75 text-hover-primary font-weight-bold font-size-h6">You</a>
                                </div>
                                <div className="symbol symbol-circle symbol-40 ml-3">
                                    <img alt="Pic" src="/dashboard-assets/media/users/300_21.jpg"/>
                                </div>
                            </div>
                            <div
                                className="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">
                                Company BBQ to celebrate the last quater achievements and goals. Food and drinks
                                provided
                            </div>
                        </div>


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
        </div>
    );
}


export default ChatBox;
