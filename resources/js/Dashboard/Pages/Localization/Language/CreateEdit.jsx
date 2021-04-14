import {useEffect} from 'react';
import Layout from "./../../../Layout/Layout";
import Topbar from './../../../Layout/Topbar';
import Content from "./../../../Layout/Content";
import Checkbox from "../../../Components/Checkbox";
import SelectComponent from './../../../Components/Select';
import InvalidFeedBack from "../../../Components/InvalidFeedback";
import FlagsSelectComponent from "../../../Components/FlagsSelectComponent";
import {useForm} from "@inertiajs/inertia-react";
import PrimaryButton from "../../../Components/PrimaryButton";

const breadcrumb = [
    {
        title: translations['dashboard'],
        href: route('dashboard.index')
    },
    {
        title: translations['languages'],
        href: route('dashboard.languages.index')
    }
];

const directionOptions = [
    {label: translations['rtl'], value: 'rtl'},
    {label: translations['ltr'], value: 'ltr'},
];

const CreateEdit = (props) => {
    const {
        data:formData,
        setData:setFormData,
        post,
        put,
        processing,
        errors
    } = useForm({
        language_id: null,
        language_name: '',
        language_code: '',
        language_direction: '',
        language_display_front: false,
        language_image: null
    })

    useEffect(() => {
        if (props.language) {
            setFormData(props.language);
        }
        return () => setFormData({})
    }, [])

    return (
        <>
            <Topbar title={props.pageTitle} breadcrumb={breadcrumb} >
                <PrimaryButton
                    classes={processing ? 'spinner spinner-white spinner-left spinner-sm' : ''}
                    onClick={() => {
                        if (formData.language_id) {
                            put(route('dashboard.languages.update', formData.language_id), {preserveState: false});
                        }else {
                            post(route('dashboard.languages.store'), {preserveState: false});
                        }
                    }}
                    disabled={processing || Object.values(formData).includes('')}
                >
                    {translations['save']}
                </PrimaryButton>
            </Topbar>

            <Content>
                <form id='form'>
                     <div className='row'>

                        <div className="card card-custom gutter-b example example-compact col-md-7">
                            <div className='card-body'>
                                <div className="form-group">
                                    <label>{translations['name']}</label>
                                    <input required type="text" onChange={(e) => setFormData('language_name', e.target.value)} value={formData.language_name} className={'form-control ' + (errors.language_name ? ' is-invalid' : '')}/>
                                    <InvalidFeedBack msg={errors.language_name}/>
                                </div>
                                <div className="form-group">
                                    <label>{translations['code']}</label>
                                    <input required type="text" onChange={(e) => setFormData('language_code', e.target.value)} value={formData.language_code} className={"form-control " + (errors.language_code ? ' is-invalid' : '')}/>
                                    <InvalidFeedBack msg={errors.language_code}/>
                                </div>
                                <div className='form-group'>
                                    <label>{translations['display_front']}</label>
                                    <Checkbox checked={formData.language_display_front} onChange={(e) => setFormData('language_display_front', e.target.checked)}/>
                                </div>
                            </div>
                        </div>

                        <div className='d-inline-block' style={{width: '20px'}}></div>

                        <div className="card card-custom gutter-b example example-compact col-md-4">
                            <div className='card-body'>
                                <div className='form-group'>
                                    <label>{translations['direction']}</label>
                                    <SelectComponent
                                        onChange={(e) => setFormData('language_direction', e.value)}
                                        options={directionOptions}
                                        value={directionOptions.filter(option => option.value == formData.language_direction)}
                                    />
                                    <InvalidFeedBack msg={errors.language_direction}/>
                                </div>
                                <div className="form-group">
                                    <label>{translations['image']}</label>
                                    <FlagsSelectComponent
                                        value={props.flags.filter(option => option.flag_svg == formData.language_image)}
                                        options={props.flags}
                                        onChange={(e) => setFormData('language_image', e.flag_svg)}
                                    />
                                    <InvalidFeedBack msg={errors.language_image}/>
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
