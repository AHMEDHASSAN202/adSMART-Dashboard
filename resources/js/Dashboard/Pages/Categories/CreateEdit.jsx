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


const breadcrumb = [
    {
        title: translations['dashboard'],
        href: route('dashboard.index')
    },
    {
        title: translations['categories'],
        href: route('dashboard.categories.index')
    }
];

const CreateEdit = (props) => {
    const {data: {languages}} = useContext(AppContext)
    const { data: formData, setData, processing, post, errors} = useForm(
        formBuilder(languages, {
            parent_id: null, image: null, category_name:'', category_slug:'', category_description:''
        }, ['category_name', 'category_slug', 'category_description'])
    );
    const tabs = getLanguagesTabs(languages);
    const {categories, category} = props
    useEffect(() => {
        if (category) {
            //when edit
            setData({...category, _method: "PUT", image: null});
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
                        if (category) {
                            post(route('dashboard.categories.update', category.category_id));
                        }else {
                            post(route('dashboard.categories.store'));
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
                             <CardComponent title={translations['new_category']} tabs={tabs}>
                                 {tabs.map((tab, i) => (
                                     <CardTab key={i} id={tab.id}>
                                         <div className="form-group">
                                             <label>{translations['name']}</label>
                                             <input type="text" onChange={(e) => {
                                                 let o = formData;
                                                 o.category_name[tab.id] = e.target.value;
                                                 o.category_slug[tab.id] = generateSlug(e.target.value);
                                                 setData({...o});
                                             } } value={formData.category_name[tab.id]} className={'form-control ' + myIf(errors, 'category_name.'+tab.id, 'is-invalid', '')} />
                                             <InvalidFeedBack msg={errors['category_name.'+tab.id]} />
                                         </div>
                                         <div className="form-group">
                                             <label>{translations['slug']}</label>
                                             <input type="text" onChange={(e) => setData('category_slug', {...formData.category_slug, [tab.id]: generateSlug(e.target.value)}) } value={formData.category_slug[tab.id]} className={'form-control ' + myIf(errors, 'category_slug.'+tab.id, 'is-invalid', '')} />
                                             <InvalidFeedBack msg={errors['category_slug.'+tab.id]} />
                                         </div>
                                         <div className="form-group">
                                             <label>{translations['description']}</label>
                                             <textarea onChange={(e) => setData('category_description', {...formData.category_description, [tab.id]: e.target.value}) } value={formData.category_description[tab.id]} className={'form-control ' + myIf(errors, 'category_description.'+tab.id, 'is-invalid', '')} ></textarea>
                                             <InvalidFeedBack msg={errors['category_description.'+tab.id]} />
                                         </div>
                                     </CardTab>
                                 ))}

                             </CardComponent>
                         </div>

                         <div className="col-md-4">
                             <CardComponent title={translations['image']}>
                                 <div className="row pr-4">
                                     <OneImageUploaderComponent full_width={true} defaultImage={{dataURL: category?.image_full_path}} onImagesChange={(image) => setData('image', image['file'])} acceptType={['png', 'jpg', 'jpeg']}/>
                                     <span className="form-text text-muted d-block">Allowed file types:  png, jpg, jpeg.</span>
                                     <InvalidFeedBack msg={errors.image}/>
                                 </div>
                             </CardComponent>
                             <CardComponent title={translations['options']}>
                                 <div className='form-group'>
                                     <label>{translations['parent'] + ' ' + translations['category']}</label>
                                     <SelectComponent
                                         getOptionLabel={(option) => option.category_name}
                                         getOptionValue={(option) => option.category_id}
                                         onChange={(e) => setData('parent_id', e.category_id)}
                                         options={categories}
                                         value={categories.filter(option => option.category_id == formData.parent_id)}
                                     />
                                     <InvalidFeedBack msg={errors.parent_id}/>
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
