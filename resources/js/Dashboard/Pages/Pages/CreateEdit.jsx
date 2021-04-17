import {useEffect, useContext} from 'react';
import Layout from "./../../Layout/Layout";
import Topbar from './../../Layout/Topbar';
import Content from "./../../Layout/Content";
import InvalidFeedBack from "../../Components/InvalidFeedback";
import CardComponent from "../../Components/CardComponent";
import { useForm } from '@inertiajs/inertia-react'
import {AppContext} from "../../AppContext";
import CardTab from "../../Components/CardTab";
import {assets, formBuilder, generateSlug, getLanguagesTabs, myIf} from "../../helpers";
import PrimaryButton from "../../Components/PrimaryButton";
import SelectComponent from "../../Components/Select";
import OneImageUploaderComponent from "../../Components/OneImageUploaderComponent";
import TinyEditor from "../../Components/TinyEditor";


const breadcrumb = [
    {
        title: translations['dashboard'],
        href: route('dashboard.index')
    },
    {
        title: translations['pages'],
        href: route('dashboard.pages.index')
    }
];

const CreateEdit = (props) => {
    const {data: {languages}} = useContext(AppContext)
    const { data: formData, setData, processing, post, errors} = useForm(
        formBuilder(languages, {
            fk_type_id: null, feature_image: null, page_slug: '', page_title: '', page_content:''
        }, ['page_slug', 'page_title', 'page_content'])
    );
    const tabs = getLanguagesTabs(languages);
    const {types, page} = props
    useEffect(() => {
        if (page) {
            //when edit
            setData({...page, _method: "PUT", feature_image: null});
        }
        return () => {
            setData({});
        }
    }, [])

    return (
        <>
            <Topbar title={props.pageTitle} breadcrumb={breadcrumb} >
                <PrimaryButton
                    classes={processing ? 'spinner spinner-white spinner-left spinner-sm' : ''}
                    onClick={() => {
                        if (page) {
                            post(route('dashboard.pages.update', page.page_id));
                        }else {
                            post(route('dashboard.pages.store'));
                        }
                    }}
                    disabled={processing}
                >
                    {translations['save']}
                </PrimaryButton>
            </Topbar>

            <Content>
                <form>
                     <div className='row'>

                         <div className="col-md-8">
                             <CardComponent title={translations['page']} tabs={tabs}>
                                 {tabs.map((tab, i) => (
                                     <CardTab key={i} id={tab.id}>
                                         <div className="form-group">
                                             <label>{translations['title']}</label>
                                             <input type="text" onChange={(e) => {
                                                 let o = formData;
                                                 o.page_title[tab.id] = e.target.value;
                                                 o.page_slug[tab.id] = generateSlug(e.target.value);
                                                 setData({...o});
                                             } } value={formData.page_title[tab.id]} className={'form-control ' + myIf(errors, 'page_title.'+tab.id, 'is-invalid', '')} />
                                             <InvalidFeedBack msg={errors['page_title.'+tab.id]} />
                                         </div>
                                         <div className="form-group">
                                             <label>{translations['slug']}</label>
                                             <input type="text" onChange={(e) => setData('page_slug', {...formData.page_slug, [tab.id]: generateSlug(e.target.value)}) } value={formData.page_slug[tab.id]} className={'form-control ' + myIf(errors, 'page_title.'+tab.id, 'is-invalid', '')} />
                                             <InvalidFeedBack msg={errors['page_slug.'+tab.id]} />
                                         </div>
                                         <div className="form-group">
                                             <label>{translations['content']}</label>
                                             <TinyEditor module={'pages'} value={formData.page_content[tab.id]} handleEditorChange={(e) => setData('page_content', {...formData.page_content, [tab.id]: e})}/>
                                             <InvalidFeedBack msg={errors['page_content.'+tab.id]} />
                                         </div>
                                     </CardTab>
                                 ))}

                             </CardComponent>
                         </div>

                         <div className="col-md-4">
                             <CardComponent title={translations['feature_image']}>
                                 <div className="row pr-4">
                                     <OneImageUploaderComponent full_width={true} defaultImage={{dataURL: page?.feature_image_full_path}} onImagesChange={(image) => setData('feature_image', image['file'])} acceptType={['png', 'jpg', 'jpeg']}/>
                                     <span className="form-text text-muted d-block">Allowed file types:  png, jpg, jpeg.</span>
                                     <InvalidFeedBack msg={errors.feature_image}/>
                                 </div>
                             </CardComponent>
                             <CardComponent title={translations['options']}>
                                 <div className='form-group'>
                                     <label>{translations['type']}</label>
                                     <SelectComponent
                                         getOptionLabel={(option) => option.type_value}
                                         getOptionValue={(option) => option.type_id}
                                         onChange={(e) => setData('fk_type_id', e.type_id)}
                                         options={types}
                                         value={types.filter(option => option.type_id == formData.fk_type_id)}
                                     />
                                     <InvalidFeedBack msg={errors.fk_type_id}/>
                                 </div>
                             </CardComponent>
                         </div>

                    </div>
                </form>
            </Content>
        </>
    );
}


CreateEdit.layout = page => <Layout children={page}/>

export default CreateEdit;
