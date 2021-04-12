import SelectComponent from "./Select";
import { components } from 'react-select';

const Option = props => {
    const { innerProps, innerRef } = props;
    return (
        <button ref={innerRef} {...innerProps} className='p-3 border-0 d-block bg-transparent'>
            <img className="h-20px w-20px rounded-sm" src={props.data.language_image_path} alt={props.data.language_name} />
            <span className='text text-muted ml-3 text-capitalize'>{props.data.language_name}</span>
        </button>
    );
};

const ControlComponent = ({ children, ...rest }) => (
    <components.Control {...rest}>
        {rest.hasValue ?
            <img className="h-20px w-20px rounded-sm ml-2" src={rest.getValue()[0].language_image_path} alt={rest.getValue()[0].language_name} />
            :  ''}
        {children}
    </components.Control>
);


const LanguagesSelectComponent = ({languageValue='language_code', ...props}) => {
    return (
        <SelectComponent
            {...props}
            getOptionLabel={(option) => option.language_name}
            getOptionValue={(option) => option[languageValue]}
            components={{Option, Control: ControlComponent}}
        />
    );
}

export default LanguagesSelectComponent;
