import {useState, useEffect} from 'react';
import Layout from "./../../../Layout/Layout";
import Topbar from './../../../Layout/Topbar';
import Content from "./../../../Layout/Content";
import SubmitButton from "../../../Components/SubmitButton";
import Checkbox from "../../../Components/Checkbox";
import SelectComponent from './../../../Components/Select';
import InvalidFeedBack from "../../../Components/InvalidFeedback";
import FlagsSelectComponent from "../../../Components/FlagsSelectComponent";

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

    const [language, setLanguage] = useState({
        language_id: null,
        language_name: '',
        language_code: '',
        language_direction: '',
        language_display_front: false,
        language_image: null
    });

    useEffect(() => {
        if (props.language) {
            setLanguage(props.language)
        }
    }, [])

    return (
        <>
            <Topbar title={props.pageTitle} breadcrumb={breadcrumb} >
                <SubmitButton href={language.language_id ? route('dashboard.languages.update', language.language_id) : route('dashboard.languages.store')} method={language.language_id ? 'PUT' : 'POST'} data={language} form='form'
                              disabled={!(language.language_name &&
                                         language.language_code &&
                                         language.language_direction &&
                                        language.language_id ? true : language.language_image)}
                              title={translations['save']}/>
            </Topbar>

            <Content>
                <form id='form'>
                     <div className='row'>

                        <div className="card card-custom gutter-b example example-compact col-md-7">
                            <div className='card-body'>
                                <div className="form-group">
                                    <label>{translations['name']}</label>
                                    <input required type="text" onChange={(e) => setLanguage({...language, language_name: e.target.value})} value={language.language_name} className={'form-control form-control-solid' + (props.errors.language_name ? ' is-invalid' : '')}/>
                                    <InvalidFeedBack msg={props.errors.language_name}/>
                                </div>
                                <div className="form-group">
                                    <label>{translations['code']}</label>
                                    <input required type="text" onChange={(e) => setLanguage({...language, language_code: e.target.value})} value={language.language_code} className={"form-control form-control-solid" + (props.errors.language_code ? ' is-invalid' : '')}/>
                                    <InvalidFeedBack msg={props.errors.language_code}/>
                                </div>
                                <div className='form-group'>
                                    <label>{translations['display_front']}</label>
                                    <Checkbox checked={language.language_display_front} onChange={(e) => setLanguage({...language, language_display_front: e.target.checked})}/>
                                </div>
                            </div>
                        </div>

                        <div className='d-inline-block' style={{width: '20px'}}></div>

                        <div className="card card-custom gutter-b example example-compact col-md-4">
                            <div className='card-body'>
                                <div className='form-group'>
                                    <label>{translations['direction']}</label>
                                    <SelectComponent
                                        onChange={(e) => setLanguage({...language, language_direction: e.value})}
                                        options={directionOptions}
                                        value={directionOptions.filter(option => option.value == language.language_direction)}
                                    />
                                    <InvalidFeedBack msg={props.errors.language_direction}/>
                                </div>
                                <div className="form-group">
                                    <label>{translations['image']}</label>
                                    <FlagsSelectComponent
                                        value={props.flags.filter(option => option.flag_svg == language.language_image)}
                                        options={props.flags}
                                        onChange={(e) => setLanguage({...language, language_image: e.flag_svg})}
                                    />
                                    <InvalidFeedBack msg={props.errors.language_image}/>
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
