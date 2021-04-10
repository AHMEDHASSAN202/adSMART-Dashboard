import {useState} from 'react';
import { usePage } from '@inertiajs/inertia-react'
import ResendVerificationNotificationLink from './ResendVerificationNotificationLink';

const Alert = () => {
    const {props:{alert}} = usePage();
    const [isClosed, setClose] = useState(false);

    if (!alert || isClosed) {
        return '';
    }

    return (
        <div className={'alert alert-custom alert-notice alert-light-'+alert.class+' fade show mb-5'} role="alert" style={{padding: '.5rem 2rem'}}>
            <div className="alert-icon"><i className={alert.icon}></i></div>
            <div className="alert-text"><strong>{alert.title}</strong> {alert.with_resend_verification_link ? <ResendVerificationNotificationLink /> : ''} </div>
            <div className="alert-close">
                <button type="button" onClick={() => setClose(true)} className="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i className="ki ki-close"></i></span>
                </button>
            </div>
        </div>
    );
}

export default Alert;
