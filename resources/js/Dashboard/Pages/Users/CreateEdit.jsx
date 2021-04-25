import {useEffect, useContext, useState} from 'react';
import Layout from "./../../Layout/Layout";
import Topbar from './../../Layout/Topbar';
import Content from "./../../Layout/Content";
import CardComponent from "../../Components/CardComponent";
import { useForm } from '@inertiajs/inertia-react'
import PrimaryButton from "../../Components/PrimaryButton";
import {assets, isTrue} from "../../helpers";
import InvalidFeedBack from "../../Components/InvalidFeedback";
import OneImageUploaderComponent from "../../Components/OneImageUploaderComponent";
import FlagsSelectComponent from "../../Components/FlagsSelectComponent";
import SelectComponent from "../../Components/Select";
import Checkbox from "../../Components/Checkbox";


const breadcrumb = [
    {
        title: translations['dashboard'],
        href: route('dashboard.index')
    },
    {
        title: translations['users'],
        href: route('dashboard.users.index')
    }
];

const CreateEdit = (props) => {
    const {user, options, flags, roles} = props;
    const [phoneCode, setPhoneCode] = useState('');
    const {
        data:formData,
        setData:setFormData,
        post,
        processing,
        errors
    } = useForm({
        fk_role_id: null,
        user_name: '',
        user_email: '',
        user_password: '',
        user_avatar: null,
        user_phone: '',
        fk_user_country: null,
        user_address: '',
        send_user_notification: false
    })

    useEffect(() => {
        if (user) {
            const {role, permissions, updated_at, created_at, id, phone_code,  ...editUser} = user;
            setFormData({...editUser, user_password: '', user_avatar: null, _method: 'PUT'});
            setPhoneCode(phone_code)
        }

        return () => {
            setFormData({})
        }
    }, [])

    return (
        <>
            <Topbar title={props.pageTitle} breadcrumb={breadcrumb} >
                <PrimaryButton
                    classes={processing ? 'spinner spinner-white spinner-left spinner-sm' : ''}
                    disabled={processing}
                    onClick={() => user ? post(route('dashboard.users.update', {user: user.user_id}), {preserveScroll: true}) : post(route('dashboard.users.store'))}>
                    {translations['save']}
                </PrimaryButton>
            </Topbar>

            <Content>
                <form id='roleForm' >
                     <div className='row'>

                         <div className="col-md-7">
                             <CardComponent title={translations['profile_information']}>
                                 <div className="form-group row">
                                     <label className="col-xl-3 col-lg-3 col-form-label">{translations['avatar']}</label>
                                     <div className="col-lg-9 col-xl-6">
                                         <OneImageUploaderComponent defaultImage={{dataURL: user?.user_avatar_full_path || assets(options['default_avatar'])}} onImagesChange={(image) => setFormData('user_avatar', image['file'])} acceptType={['png', 'jpg', 'jpeg']}/>
                                         <span className="form-text text-muted">Allowed file types:  png, jpg, jpeg.</span>
                                         <InvalidFeedBack msg={errors.user_avatar}/>
                                     </div>
                                 </div>
                                 <div className="form-group row">
                                     <label className="col-3 col-form-label" htmlFor="name">{translations['name']}</label>
                                     <div className="col-9">
                                         <input
                                             className={'form-control' + (errors.user_name ? ' is-invalid' : '')}
                                             type="text"
                                             value={formData.user_name}
                                             id="user_name"
                                             onChange={(e) => setFormData('user_name', e.target.value)}
                                         />
                                         <InvalidFeedBack msg={errors.user_name}/>
                                     </div>
                                 </div>
                                 <div className="form-group row">
                                     <label className="col-3 col-form-label" htmlFor="email">{translations['email']}</label>
                                     <div className="col-9">
                                         <input
                                             className={'form-control' + (errors.user_email ? ' is-invalid' : '')}
                                             type="email"
                                             value={formData.user_email}
                                             id="email"
                                             onChange={(e) => setFormData('user_email', e.target.value)}
                                         />
                                         <InvalidFeedBack msg={errors.user_email}/>
                                     </div>
                                 </div>
                                 <div className="form-group row">
                                     <label className="col-3 col-form-label" htmlFor="password">{translations['password']}</label>
                                     <div className="col-9">
                                         <input
                                             className={'form-control' + (errors.user_password ? ' is-invalid' : '')}
                                             type="password"
                                             value={formData.user_password}
                                             id="password"
                                             onChange={(e) => setFormData('user_password', e.target.value)}
                                         />
                                         <InvalidFeedBack msg={errors.user_password}/>
                                     </div>
                                 </div>
                                 {!user ?
                                     <div className='form-group row'>
                                         <label className="col-3 col-form-label">{translations['send_user_notification_about_their_account']}</label>
                                         <div className="col-9">
                                             <Checkbox checked={isTrue(formData.send_user_notification)} onChange={(e) => setFormData('send_user_notification', e.target.checked)} label={translations['send_user_notification_about_their_account_msg']}/>
                                             <InvalidFeedBack msg={errors.send_user_notification}/>
                                         </div>
                                     </div> : ''}
                             </CardComponent>
                         </div>

                         <div className="col-md-5">
                             <div className="row">
                                 <div className="col-12">
                                     <CardComponent title={translations['personal_options']}>
                                         <div className="form-group row">
                                             <label className="col-3 col-form-label" htmlFor="country">{translations['country']}</label>
                                             <div className="col-9">
                                                 <FlagsSelectComponent
                                                     options={flags}
                                                     value={flags.filter(f => f.flag_id == formData.fk_user_country)}
                                                     onChange={(f) => {
                                                         setFormData('fk_user_country', f.flag_id)
                                                         setPhoneCode(f.phone_code)
                                                     }}
                                                     flagValue={'flag_id'}
                                                     id={'country'}
                                                 />
                                                 <InvalidFeedBack msg={errors.fk_user_country}/>
                                             </div>
                                         </div>
                                         <div className="form-group row">
                                             <label className="col-3 col-form-label" htmlFor="phone">{translations['phone']}</label>
                                             <div className="col-9 input-group">
                                                 <div className="input-group-prepend">
                                                    <span className="input-group-text" style={{width: 40}}>
                                                        +{phoneCode}
                                                    </span>
                                                 </div>
                                                 <input
                                                     className={'form-control' + (errors.user_phone ? ' is-invalid' : '')}
                                                     type="text"
                                                     value={formData.user_phone || ''}
                                                     id="phone"
                                                     onChange={(e) => setFormData('user_phone', e.target.value)}
                                                 />
                                                 <InvalidFeedBack msg={errors.user_phone}/>
                                             </div>
                                         </div>
                                         <div className="form-group row">
                                             <label className="col-3 col-form-label" htmlFor="address">{translations['address']}</label>
                                             <div className="col-9">
                                                 <input
                                                     className={'form-control' + (errors.user_address ? ' is-invalid' : '')}
                                                     type="text"
                                                     value={formData.user_address || ''}
                                                     id="address"
                                                     onChange={(e) => setFormData('user_address', e.target.value)}
                                                 />
                                                 <InvalidFeedBack msg={errors.user_address}/>
                                             </div>
                                         </div>
                                     </CardComponent>
                                 </div>
                                 <div className="col-12">
                                     <CardComponent title={translations['roles']}>
                                         <div className='form-group'>
                                             <label>{translations['role']}</label>
                                             <SelectComponent
                                                 getOptionLabel={(option) => option.name}
                                                 getOptionValue={(option) => option.role_id}
                                                 onChange={(e) => setFormData('fk_role_id', e.role_id)}
                                                 options={roles}
                                                 value={roles.filter(option => option.role_id == formData.fk_role_id)}
                                             />
                                             <InvalidFeedBack msg={errors.fk_role_id}/>
                                         </div>
                                     </CardComponent>
                                 </div>
                             </div>
                         </div>

                    </div>
                </form>
            </Content>
        </>
    );
}


CreateEdit.layout = page => <Layout children={page}/>

export default CreateEdit;
