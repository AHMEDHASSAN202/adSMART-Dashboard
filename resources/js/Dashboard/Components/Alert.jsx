import {useContext, useEffect, useState} from 'react';
import { usePage } from '@inertiajs/inertia-react'
import ResendVerificationNotificationLink from './ResendVerificationNotificationLink';
import {AppContext} from "../AppContext";
import {updateAlert} from "../actions";

const Alert = () => {
    const {props:{alert}} = usePage();
    const {data:{clientAlert}, dispatch} = useContext(AppContext);
    const [serverAlert, setServerAlert] = useState(null);

    useEffect(() => { setServerAlert(alert)}, [alert])

    if ((!serverAlert && !clientAlert)) {
        return '';
    }

    let al = serverAlert ? serverAlert : clientAlert;

    return (
        <div className={'alert alert-custom alert-notice alert-light-'+al.class+' fade show mb-5'} role="alert" style={{padding: '.5rem 2rem'}}>
            <div className="alert-icon"><i className={al.icon}></i></div>
            <div className="alert-text"><strong>{al.title}</strong> {al.with_resend_verification_link ? <ResendVerificationNotificationLink /> : ''} </div>
            <div className="alert-close">
                <button type="button" onClick={() => {setServerAlert(null); dispatch(updateAlert(null))}} className="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i className="ki ki-close"></i></span>
                </button>
            </div>
        </div>
    );
}

export default Alert;
