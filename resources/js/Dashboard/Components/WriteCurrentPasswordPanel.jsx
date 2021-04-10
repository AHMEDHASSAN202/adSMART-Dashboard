import {useState} from 'react';
import PrimaryButton from "./PrimaryButton";
import InvalidFeedBack from "./InvalidFeedback";
import { Inertia } from '@inertiajs/inertia'

const  WriteCurrentPasswordPanel = ({isOpen, setOpen, url, data={}, onSuccess=null, onError=null}) => {
    const [currentPassword, setCurrentPassword] = useState('')
    const [sendFlag, setSendFlag] = useState(false)
    const [error, setError] = useState('');
    return (
        <div id="kt_quick_user" className={"offcanvas offcanvas-right p-10 offcanvas-current-password " + (isOpen ? 'offcanvas-on' : '')}>
            <div className="offcanvas-content pr-5 mr-n5">
                <div className="form-group row">
                    <label htmlFor="currentPassword"><strong>{translations['current_password']}</strong></label>
                    <input className={'form-control ' + (error ? 'is-invalid' : '')}
                           type="password"
                           placeholder={translations['current_password']}
                           value={currentPassword}
                           id="currentPassword"
                           onChange={(e) => {
                               setCurrentPassword(e.target.value);
                           }}
                    />
                    {error ? <InvalidFeedBack msg={error}/> : ''}
                </div>
                <PrimaryButton
                    type='submit'
                    classes={sendFlag ? 'spinner spinner-white spinner-left spinner-sm' : ''}
                    disabled={(currentPassword == '') || sendFlag}
                    onClick={() => {
                        if (currentPassword == '' || currentPassword == null) {
                            setError(new String(translations['validation::required']).replace(':attribute', translations['current_password']));
                            setSendFlag(false);
                            return false;
                        }
                        Inertia.post(
                            url,
                            {...data, currentPassword: currentPassword},
                            {
                                onStart: (visit) => {
                                    setSendFlag(true);
                                },
                                onSuccess: (page) => {
                                    if (onSuccess) onSuccess(page)
                                    setOpen(false);
                                    setCurrentPassword('')
                                },
                                onError: (errors) => {
                                    setError(errors['currentPassword'])
                                    if (onError) onError(errors)
                                },
                                onFinish: visit => {
                                    setSendFlag(false)
                                },
                                preserveScroll: (page) => Object.keys(page.props.errors).length,
                            }
                        );
                    }}>
                    {translations['send']}
                </PrimaryButton>
                <button
                    className='btn btn-secondary mx-3'
                    onClick={() => {
                        setOpen(false);
                        setCurrentPassword('');
                        setError('')
                }}>{translations['close']}</button>
            </div>
        </div>
    );
}

export default WriteCurrentPasswordPanel;
