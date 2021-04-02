import {useState} from 'react';
import { Inertia } from '@inertiajs/inertia'

const LanguagesDropdown = ({languages}) => {
    const [toggleDropdown, setToggleDropdown] = useState(false);
    const switchLanguages = (lang_code) => {
        axios.put(route('visitors.updateInformation'), {default_lang: lang_code})
             .then(() => window.location.reload())
    }
    return (
        <div className="dropdown">
            <button className="topbar-item border-0 bg-transparent" data-toggle="dropdown" data-offset="10px,0px" onClick={() => setToggleDropdown(!toggleDropdown)}>
                <div className="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                    <img className="h-20px w-20px rounded-sm" src={window.currentLanguage.language_image_path} alt={window.currentLanguage.language_name} />
                </div>
            </button>

            <div className={'dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right ' + (toggleDropdown ? 'show dropdown-animation' : '')}>
                <ul className="navi navi-hover py-4">
                    {languages.map((lang, i) => (
                        <li className="navi-item" key={i}>
                            <button onClick={() => switchLanguages(lang.language_code)} className="navi-link border-0 bg-transparent d-block">
                                <span className="symbol symbol-20 mr-3">
                                    <img src={lang.language_image_path} alt={lang.language_name} />
                                </span>
                                <span className="navi-text">{lang.language_name}</span>
                            </button>
                        </li>
                    ))}

                </ul>
            </div>
        </div>
    )
}


export default LanguagesDropdown;
