import {useState} from 'react';
import Layout from "./../../Layout/Layout";
import Topbar from './../../Layout/Topbar';
import Content from "./../../Layout/Content";
import PrimaryButton from "../../Components/PrimaryButton";
import CardComponent from "../../Components/CardComponent";
import OneImageUploaderComponent from "../../Components/OneImageUploaderComponent";
import FlagsSelectComponent from "../../Components/FlagsSelectComponent";
import WriteCurrentPasswordPanel from "../../Components/WriteCurrentPasswordPanel";
import { useForm } from '@inertiajs/inertia-react'
import InvalidFeedBack from "../../Components/InvalidFeedback";

const breadcrumb = [
    {
        title: translations['dashboard'],
        href: route('dashboard.index')
    }
];


const Index = (props) => {
    console.log(props);
    const {profile: {personal_info, ...profile}, loggedActivities, myActivities, flags} = props;
    const [isPasswordPanelOpen, setPasswordPanelOpen] = useState(false);
    const [phoneCode, setPhoneCode] = useState(personal_info.phone_code);
    const {
        data:profileInfoData,
        setData:profileInfoSetData,
        post:profileInfoPut,
        processing:profileInfoProcessing,
        errors:profileInfoErrors
    } = useForm({
        user_name: profile.user_name,
        user_email: profile.user_email,
        user_avatar: null,
        _method: 'PUT'
    })
    const {
        data:personalInfoData,
        setData:personalInfoSetData,
        put:personalInfoPut,
        processing:personalInfoProcessing,
        errors:personalInfoErrors,
        transform: personalInfoTransform
    } = useForm({
        fk_user_country: personal_info.fk_user_country,
        user_phone: personal_info.user_phone,
        user_address: personal_info.user_address,
    })
    personalInfoTransform((data) => ({...data, user_phone: new Number(data.user_phone)}))
    const {
            data:changePasswordData,
            setData:changePasswordSetData,
            put:changePasswordPut,
            processing:changePasswordProcessing,
            errors:changePasswordErrors,
            reset: resetPasswordFields
    } = useForm({
        current_password: '',
        password: '',
        password_confirmation: ''
    })
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
                        <CardComponent
                            footer={
                                <PrimaryButton
                                    classes={profileInfoProcessing ? 'spinner spinner-white spinner-left spinner-sm' : ''}
                                    disabled={profileInfoProcessing}
                                    onClick={() => profileInfoPut(route('auth.dashboard.profile.info.update'), {preserveScroll: true}) }>{translations['update']
                                    }</PrimaryButton>
                            }
                        >
                            <div className="form-group row">
                                <label className="col-xl-3 col-lg-3 col-form-label">{translations['avatar']}</label>
                                <div className="col-lg-9 col-xl-6">
                                    <OneImageUploaderComponent defaultImage={{dataURL: profile.user_avatar_full_path}} onImagesChange={(image) => profileInfoSetData('user_avatar', image['file'])} acceptType={['png', 'jpg', 'jpeg']}/>
                                    <span className="form-text text-muted">Allowed file types:  png, jpg, jpeg.</span>
                                    {profileInfoErrors.user_avatar ? <InvalidFeedBack msg={profileInfoErrors.user_avatar}/> : ''}
                                </div>
                            </div>
                            <div className="form-group row">
                                <label className="col-2 col-form-label" htmlFor="name">{translations['name']}</label>
                                <div className="col-10">
                                    <input
                                        min={3}
                                        max={100}
                                        required
                                        className={'form-control' + (profileInfoErrors.user_name ? ' in-invalid' : '')}
                                        type="text"
                                        value={profileInfoData.user_name}
                                        id="user_name"
                                        onChange={(e) => profileInfoSetData('user_name', e.target.value)}
                                    />
                                    {profileInfoErrors.user_name ? <InvalidFeedBack msg={profileInfoErrors.user_name}/> : ''}
                                </div>
                            </div>
                            <div className="form-group row">
                                <label className="col-2 col-form-label" htmlFor="email">{translations['email']}</label>
                                <div className="col-10">
                                    <input
                                        min={3}
                                        max={100}
                                        required
                                        className={'form-control' + (profileInfoErrors.user_email ? ' in-invalid' : '')}
                                        type="email"
                                        value={profileInfoData.user_email}
                                        id="email"
                                        onChange={(e) => profileInfoSetData('user_email', e.target.value)}
                                    />
                                    {profileInfoErrors.user_email ? <InvalidFeedBack msg={profileInfoErrors.user_email}/> : ''}
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
                        <CardComponent
                            footer={
                                <PrimaryButton
                                    classes={personalInfoProcessing ? 'spinner spinner-white spinner-left spinner-sm' : ''}
                                    disabled={personalInfoProcessing}
                                    onClick={() => personalInfoPut(route('auth.dashboard.personal.options.update'), {preserveScroll: true})}
                                >{translations['update']}</PrimaryButton>
                            }
                        >
                            <div className="form-group row">
                                <label className="col-2 col-form-label" htmlFor="country">{translations['country']}</label>
                                <div className="col-10">
                                    <FlagsSelectComponent
                                        options={flags}
                                        value={flags.filter(f => f.flag_id == personalInfoData.fk_user_country)}
                                        onChange={(f) => {
                                            personalInfoSetData('fk_user_country', f.flag_id);
                                            setPhoneCode(f.phone_code)
                                        }}
                                        flagValue={'flag_id'}
                                        id={'country'}
                                    />
                                </div>
                            </div>
                            <div className="form-group row">
                                <label className="col-2 col-form-label" htmlFor="phone">{translations['phone']}</label>
                                <div className="col-10 input-group">
                                    <div className="input-group-prepend">
                                        <span className="input-group-text" style={{width: 60}}>
                                            +{phoneCode}
                                        </span>
                                    </div>
                                    <input
                                        min={11}
                                        max={11}
                                        className={'form-control' + (personalInfoErrors.user_phone ? ' in-invalid' : '')}
                                        type="number"
                                        value={personalInfoData.user_phone}
                                        id="phone"
                                        onChange={(e) => personalInfoSetData('user_phone', e.target.value)}
                                    />
                                    {personalInfoErrors.user_phone ? <InvalidFeedBack msg={personalInfoErrors.user_phone}/> : ''}
                                </div>
                            </div>
                            <div className="form-group row">
                                <label className="col-2 col-form-label" htmlFor="address">{translations['address']}</label>
                                <div className="col-10">
                                    <input
                                        min={3}
                                        max={200}
                                        required
                                        className={'form-control' + (personalInfoErrors.user_address ? ' in-invalid' : '')}
                                        type="text"
                                        value={personalInfoData.user_address}
                                        id="address"
                                        onChange={(e) => personalInfoSetData('user_address', e.target.value)}
                                    />
                                    {personalInfoErrors.user_address ? <InvalidFeedBack msg={personalInfoErrors.user_address}/> : ''}
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
                        <CardComponent
                            footer={
                                <PrimaryButton
                                    onClick={() => {
                                        changePasswordPut(route('auth.dashboard.profile.change.password'), {preserveScroll: true});
                                        resetPasswordFields();
                                    }}
                                    classes={changePasswordProcessing ? 'spinner spinner-white spinner-left spinner-sm' : ''}
                                    disabled={changePasswordProcessing}
                                >
                                    {translations['update_password']}
                                </PrimaryButton>
                            }
                        >
                            <div className="form-group row">
                                <label className="col-2 col-form-label" htmlFor="current_password">{translations['current_password']}</label>
                                <div className="col-10">
                                    <input
                                        min={6}
                                        max={100}
                                        required
                                        className={'form-control' + (changePasswordData.current_password ? ' in-invalid' : '')}
                                        type="password"
                                        value={changePasswordData.current_password}
                                        onChange={e => changePasswordSetData('current_password', e.target.value)}
                                        id="current_password"
                                    />
                                    {changePasswordErrors.current_password ? <InvalidFeedBack msg={changePasswordErrors.current_password}/> : ''}
                                </div>
                            </div>
                            <div className="form-group row">
                                <label className="col-2 col-form-label" htmlFor="password">{translations['password']}</label>
                                <div className="col-10">
                                    <input
                                        min={6}
                                        max={100}
                                        className={'form-control' + (changePasswordData.password ? ' in-invalid' : '')}
                                        type="password"
                                        value={changePasswordData.password}
                                        onChange={e => changePasswordSetData('password', e.target.value)}
                                        id="password"
                                    />
                                    {changePasswordErrors.password ? <InvalidFeedBack msg={changePasswordErrors.password}/> : ''}
                                </div>
                            </div>
                            <div className="form-group row">
                                <label className="col-2 col-form-label" htmlFor="confirm_password">{translations['confirm_password']}</label>
                                <div className="col-10">
                                    <input
                                        min={6}
                                        max={100}
                                        className={'form-control' + (changePasswordData.password_confirmation ? ' in-invalid' : '')}
                                        type="password"
                                        value={changePasswordData.password_confirmation}
                                        onChange={e => changePasswordSetData('password_confirmation', e.target.value)}
                                        id="confirm_password"
                                    />
                                    {changePasswordErrors.password_confirmation ? <InvalidFeedBack msg={changePasswordErrors.password_confirmation}/> : ''}
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
                                {loggedActivities.map((activity, key) => (
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
