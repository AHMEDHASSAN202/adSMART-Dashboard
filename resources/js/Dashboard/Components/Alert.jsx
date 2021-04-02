import {useContext, useEffect} from 'react';
import { usePage } from '@inertiajs/inertia-react'
import {AppContext} from "../AppContext";
import {updateAlert} from "../actions";

const Alert = () => {
    const {data, dispatch} = useContext(AppContext);
    const {alert} = data;
    const {props} = usePage();

    useEffect(() => {
        dispatch(updateAlert(props.alert));
    }, [props.alert])

    if (!alert) {
        return '';
    }

    return (
        <div className={'alert alert-custom alert-notice alert-light-'+alert.class+' fade show mb-5'} role="alert" style={{padding: '.5rem 2rem'}}>
            <div className="alert-icon"><i className={alert.icon}></i></div>
            <div className="alert-text"><strong>{alert.title}</strong></div>
            <div className="alert-close">
                <button type="button" onClick={() => dispatch(updateAlert(null))} className="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i className="ki ki-close"></i></span>
                </button>
            </div>
        </div>
    );
}

export default Alert;
