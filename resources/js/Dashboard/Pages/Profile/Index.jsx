import {useState} from 'react';
import Layout from "./../../Layout/Layout";
import Topbar from './../../Layout/Topbar';
import Content from "./../../Layout/Content";
import PrimaryButton from "../../Components/PrimaryButton";
import CardComponent from "../../Components/CardComponent";
import OneImageUploaderComponent from "../../Components/OneImageUploaderComponent";
import FlagsSelectComponent from "../../Components/FlagsSelectComponent";
import WriteCurrentPasswordPanel from "../../Components/WriteCurrentPasswordPanel";

const breadcrumb = [
    {
        title: translations['dashboard'],
        href: route('dashboard.index')
    }
];


const Index = (props) => {
    console.log(props);
    const {profile, flags} = props;
    const [isPasswordPanelOpen, setPasswordPanelOpen] = useState(false);
    return (
        <>
            <WriteCurrentPasswordPanel
                isOpen={isPasswordPanelOpen}
                setOpen={setPasswordPanelOpen}
                url={route('auth.dashboard.profile.logout.other.devices')}
            />
            <Topbar title={translations['profile_info']} breadcrumb={breadcrumb} />
            <Content>
                <div className="row mb-2">
                    <div className="col-md-4">
                        <h3 className="font-weight-bold h-p text-secondary">{translations['profile_information']}</h3>
                        <small className='font-size-sm text-muted h-small'>{translations['update_your_profile_msg']}</small>
                    </div>
                    <div className="col-md-8">
                        <CardComponent>
                            <div className="form-group row">
                                <label className="col-xl-3 col-lg-3 col-form-label">{translations['avatar']}</label>
                                <div className="col-lg-9 col-xl-6">
                                    <OneImageUploaderComponent defaultImage={{dataURL: '/dashboard-assets/media/users/300_21.jpg'}} onImagesChange={(imageList) => console.log(imageList)} acceptType={['png', 'jpg', 'jpeg']}/>
                                    <span className="form-text text-muted">Allowed file types:  png, jpg, jpeg.</span>
                                </div>
                            </div>
                            <div className="form-group row">
                                <label className="col-2 col-form-label" htmlFor="name">{translations['name']}</label>
                                <div className="col-10">
                                    <input min={3} max={100} required className="form-control" type="text" value="" id="name" />
                                </div>
                            </div>
                            <div className="form-group row">
                                <label className="col-2 col-form-label" htmlFor="email">{translations['email']}</label>
                                <div className="col-10">
                                    <input min={3} max={100} required className="form-control" type="email" value="" id="email"/>
                                </div>
                            </div>
                            <div className="form-group row">
                                <label className="col-2 col-form-label" htmlFor="phone">{translations['phone']}</label>
                                <div className="col-10">
                                    <input min={11} max={11} className="form-control" type="text" value="" id="phone"/>
                                </div>
                            </div>
                        </CardComponent>
                    </div>
                </div>

                <div className="row mb-2">
                    <div className="col-md-4">
                        <h3 className="font-weight-bold h-p text-secondary">{translations['personal_options']}</h3>
                        <small className='font-size-sm text-muted h-small'>{translations['update_your_personal_options_msg']}</small>
                    </div>
                    <div className="col-md-8">
                        <CardComponent>
                            <div className="form-group row">
                                <label className="col-2 col-form-label" htmlFor="country">{translations['country']}</label>
                                <div className="col-10">
                                    <FlagsSelectComponent
                                        options={flags}
                                        onChange={(e) => console.log(e)}
                                        flagValue={'flag_name'}
                                        id={'country'}
                                    />
                                </div>
                            </div>
                            <div className="form-group row">
                                <label className="col-2 col-form-label" htmlFor="address">{translations['address']}</label>
                                <div className="col-10">
                                    <input min={3} max={200} required className="form-control" type="text" value="" id="address" />
                                </div>
                            </div>
                        </CardComponent>
                    </div>
                </div>

                <div className="row mb-2">
                    <div className="col-md-4">
                        <h3 className="font-weight-bold h-p text-secondary">{translations['change_password']}</h3>
                        <small className='font-size-sm text-muted h-small'>{translations['change_password_desc']}</small>
                    </div>
                    <div className="col-md-8">
                        <CardComponent>
                            <div className="form-group row">
                                <label className="col-2 col-form-label" htmlFor="current_password">{translations['current_password']}</label>
                                <div className="col-10">
                                    <input min={6} max={100} required className="form-control" type="password" value="" id="current_password"/>
                                </div>
                            </div>
                            <div className="form-group row">
                                <label className="col-2 col-form-label" htmlFor="password">{translations['password']}</label>
                                <div className="col-10">
                                    <input min={6} max={100} className="form-control" type="password" value="" id="password"/>
                                </div>
                            </div>
                            <div className="form-group row">
                                <label className="col-2 col-form-label" htmlFor="confirm_password">{translations['confirm_password']}</label>
                                <div className="col-10">
                                    <input min={6} max={100} className="form-control" type="password" value="" id="confirm_password"/>
                                </div>
                            </div>
                        </CardComponent>
                    </div>
                </div>

                <div className="row mb-2">
                    <div className="col-md-4">
                        <h3 className="font-weight-bold h-p text-secondary">{translations['browser_sessions']}</h3>
                        <small className='font-size-sm text-muted h-small'>{translations['browser_sessions_desc']}</small>
                    </div>
                    <div className="col-md-8">
                        <CardComponent footer={
                            <PrimaryButton onClick={() => setPasswordPanelOpen(!isPasswordPanelOpen)}>{translations['logout_others_sessions']}</PrimaryButton>
                        }>
                            <p className='lead text-warning text-decoration-underline'>{translations['feel_account_has_been_compromised_msg']}</p>
                            <ul className='list-unstyled'>
                                {profile.loggedActivities.map((activity, key) => (
                                    <li key={key}>
                                        <div className="d-flex align-items-center flex-wrap mb-10">
                                            <div className="symbol symbol-50 symbol-light mr-5">
                                                <span className="symbol-label d-block">
                                                    {activity.device_type ?
                                                        {
                                                            desktop: <i className='flaticon-laptop icon-3x d-flex justify-content-center align-items-center h-100'></i>,
                                                            mobile: <i className='fas fa-mobile-alt icon-3x d-flex justify-content-center align-items-center h-100'></i>
                                                        }[activity.device_type]
                                                        : ''
                                                    }
                                                </span>
                                            </div>
                                            <div className="d-flex flex-column flex-grow-1 mr-2">
                                                {activity.platform}
                                                <span className="text-muted font-weight-bold">{activity.browser} / {activity.ip_address} - {activity.created_at} {activity.currentDevice ? <span className='text-info font-weight-bold'>Current Device</span> : ''}</span>
                                            </div>
                                        </div>
                                    </li>
                                ))}
                                <li></li>
                            </ul>
                        </CardComponent>
                    </div>
                </div>

                <div className="row mb-15">
                    <div className="col-md-4">
                        <h3 className="font-weight-bold h-p text-secondary">{translations['recent_activities']}</h3>
                        <small className='font-size-sm text-muted h-small'>{translations['update_my_activities_msg']}</small>
                    </div>
                    <div className="col-md-8">
                        <CardComponent>
                            <div className="timeline timeline-6 mt-3">

                                <div className="timeline-item align-items-start">

                                    <div className="timeline-label font-weight-bolder text-dark-75 font-size-lg">08:42
                                    </div>

                                    <div className="timeline-badge">
                                        <i className="fa fa-genderless text-warning icon-xl"></i>
                                    </div>

                                    <div className="font-weight-mormal font-size-lg timeline-content text-muted pl-3">
                                        Outlines keep you honest. And keep structure
                                    </div>
                                </div>

                                <div className="timeline-item align-items-start">

                                    <div className="timeline-label font-weight-bolder text-dark-75 font-size-lg">08:42
                                    </div>

                                    <div className="timeline-badge">
                                        <i className="fa fa-genderless text-danger icon-xl"></i>
                                    </div>

                                    <div className="font-weight-mormal font-size-lg timeline-content text-muted pl-3">
                                        Outlines keep you honest. And keep structure
                                    </div>
                                </div>

                                <div className="timeline-item align-items-start">

                                    <div className="timeline-label font-weight-bolder text-dark-75 font-size-lg">08:42
                                    </div>

                                    <div className="timeline-badge">
                                        <i className="fa fa-genderless text-primary icon-xl"></i>
                                    </div>

                                    <div className="font-weight-mormal font-size-lg timeline-content text-muted pl-3">
                                        Outlines keep you honest. And keep structure
                                    </div>
                                </div>

                            </div>
                        </CardComponent>
                    </div>
                </div>
            </Content>
        </>
    );
}


Index.layout = page => <Layout children={page}/>

export default Index;
