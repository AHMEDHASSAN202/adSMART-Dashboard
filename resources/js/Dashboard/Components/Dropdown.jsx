import {useState} from 'react';

const Dropdown = ({children, buttonBody= <i className="ki ki-bold-more-hor icon-md"></i>}) => {
    const [toggleDropdown, setToggleDropdown] = useState(false);
    return (
        <>
            <button
                type="button"
                className="btn btn-clean btn-sm btn-icon btn-icon-md"
                onClick={() => setToggleDropdown(!toggleDropdown)}
            >
                {buttonBody}
            </button>
            <div className={'dropdown-menu p-0 m-0 dropdown-menu-left dropdown-menu-md my-dropdown-menu' + (toggleDropdown ? ' show' : '')}>
                {children}
            </div>
        </>
    )
}


export default Dropdown;
