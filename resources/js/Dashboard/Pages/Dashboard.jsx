import {useContext, useEffect, useState} from 'react';
import Layout from "./../Layout/Layout";
import Topbar from './../Layout/Topbar';
import {AppContext} from "../AppContext";
import { InertiaLink } from '@inertiajs/inertia-react'
import Content from "../Layout/Content";
import Service from "../Service";
import {assets} from "../helpers";
import {setOnlineUsers} from "../actions";
import Loading from "../Components/Loading";

const Dashboard = (props) => {
    const {data:{onlineUsers}} = useContext(AppContext);
    const {countUsers, countPages, countCategories, latestUsers, auth:{user_token, user_id}} = props;
    const [onlineUsersState, setOnlineUsersState] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        Service.getOnlineUsers(user_token)
               .then(({data}) => {
                   if (data) {
                       setOnlineUsersState(data.onlineUsers)
                   }
               })
               .finally(() => setLoading(false))
    }, [])

    return (
        <>
            <Topbar title={props.pageTitle} breadcrumb={[]} />
            <Content>

                <div className="row">
                    <div className="col-md-3 col-sm-6">
                        <div className="card card-custom bg-info gutter-b" style={{height: '150px'}}>
                            <div className="card-body">
                                <span className="svg-icon svg-icon-3x svg-icon-white ml-n2">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fillRule="nonzero" opacity="0.3"></path>
                                            <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fillRule="nonzero"></path>
                                        </g>
                                    </svg>
                                </span>
                                <div className="text-inverse-success font-weight-bolder font-size-h1 mt-3">{countUsers}</div>
                                <a href="#" className="text-inverse-success font-weight-bold font-size-h3 mt-1">{translations['users']}</a>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-3 col-sm-6">
                        <div className="card card-custom bg-info gutter-b" style={{height: '150px'}}>
                            <div className="card-body">
                                <span className="svg-icon svg-icon-3x svg-icon-white ml-n2">
                                     <svg xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                            <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                </span>
                                <div className="text-inverse-success font-weight-bolder font-size-h1 mt-3">{countPages}</div>
                                <a href="#" className="text-inverse-success font-weight-bold font-size-h3 mt-1">{translations['pages']}</a>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-3 col-sm-6">
                        <div className="card card-custom bg-info gutter-b" style={{height: '150px'}}>
                            <div className="card-body">
                                <span className="svg-icon svg-icon-3x svg-icon-white ml-n2">
                                     <svg xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3"></path>
                                            <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000"></path>
                                        </g>
                                    </svg>
                                </span>
                                <div className="text-inverse-success font-weight-bolder font-size-h1 mt-3">{countCategories}</div>
                                <a href="#" className="text-inverse-success font-weight-bold font-size-h3 mt-1">{translations['categories']}</a>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-3 col-sm-6">
                        <div className="card card-custom bg-info gutter-b" style={{height: '150px'}}>
                            <div className="card-body">
                                <span className="svg-icon svg-icon-3x svg-icon-white ml-n2">
                                     <svg xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <rect fill="#000000" opacity="0.3" x="2" y="3" width="20" height="18" rx="2"></rect>
                                            <path d="M9.9486833,13.3162278 C9.81256925,13.7245699 9.43043041,14 9,14 L5,14 C4.44771525,14 4,13.5522847 4,13 C4,12.4477153 4.44771525,12 5,12 L8.27924078,12 L10.0513167,6.68377223 C10.367686,5.73466443 11.7274983,5.78688777 11.9701425,6.75746437 L13.8145063,14.1349195 L14.6055728,12.5527864 C14.7749648,12.2140024 15.1212279,12 15.5,12 L19,12 C19.5522847,12 20,12.4477153 20,13 C20,13.5522847 19.5522847,14 19,14 L16.118034,14 L14.3944272,17.4472136 C13.9792313,18.2776054 12.7550291,18.143222 12.5298575,17.2425356 L10.8627389,10.5740611 L9.9486833,13.3162278 Z" fill="#000000" fillRule="nonzero"></path>
                                            <circle fill="#000000" opacity="0.3" cx="19" cy="6" r="1"></circle>
                                        </g>
                                    </svg>
                                </span>
                                <div className="text-inverse-success font-weight-bolder font-size-h1 mt-3">{onlineUsers.length}</div>
                                <a href="#" className="text-inverse-success font-weight-bold font-size-h3 mt-1">{translations['online_users']}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="row">
                    <div className="col-xl-4">

                        <div className="card card-custom card-stretch gutter-b">

                            <div className="card-header border-0">
                                <h3 className="card-title font-weight-bolder text-info">{translations['online_users'] || 'Online Users'}</h3>
                            </div>

                            <div className="card-body pt-2">
                                {loading && <Loading />}
                                {onlineUsersState.map((user, i) => (
                                    <div key={i} className="d-flex align-items-center mb-10">

                                        <div className="symbol symbol-60 symbol-light-white mr-5">
                                            <div className="symbol-label">
                                                <img src={assets(user.user_avatar)} className="h-75 align-self-end" alt={user.user_name}/>
                                            </div>
                                        </div>

                                        <div className="d-flex flex-column flex-grow-1 font-weight-bold">
                                            <a href="#" className="text-dark text-hover-primary mb-1 font-size-lg">{user.user_name}</a>
                                            <span className="text-muted">{user.user_email}</span>
                                        </div>

                                        {user_id != user.user_id && <InertiaLink as='button' className='btn btn-dark font-weight-bolder btn-sm text-uppercase'>{translations['start_chat'] || 'start chat'}</InertiaLink>}
                                    </div>
                                ))}

                            </div>
                        </div>
                    </div>

                    <div className="col-xl-4">

                        <div className="card card-custom card-stretch gutter-b">

                            <div className="card-header border-0">
                                <h3 className="card-title font-weight-bolder text-info">{translations['latest'] + ' ' + translations['users']}</h3>
                            </div>

                            <div className="card-body pt-2">

                                {latestUsers.map((usr, key) => (
                                    <div key={key} className="d-flex align-items-center mb-10">

                                        <div className="symbol symbol-60 symbol-light-white mr-5">
                                            <div className="symbol-label">
                                                <img src={assets(usr.user_avatar)} className="h-75 align-self-end" alt={usr.user_name}/>
                                            </div>
                                        </div>

                                        <div className="d-flex flex-column flex-grow-1 font-weight-bold">
                                            <a href="#" className="text-dark text-hover-primary mb-1 font-size-lg">{usr.user_name}</a>
                                            <span className="text-muted">{usr.user_email}</span>
                                        </div>
                                    </div>
                                ))}

                            </div>
                        </div>
                    </div>
                </div>
            </Content>
        </>
    );
}


Dashboard.layout = page => <Layout children={page}/>

export default Dashboard;
