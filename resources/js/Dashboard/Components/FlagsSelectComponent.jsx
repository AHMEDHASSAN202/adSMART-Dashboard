import SelectComponent from "./Select";
import { components } from 'react-select';

const Option = props => {
    const { innerProps, innerRef } = props;
    return (
        <button ref={innerRef} {...innerProps} className='p-3 border-0 d-block bg-transparent'>
            <img className="h-20px w-20px rounded-sm" src={props.data.flag_path} alt={props.data.flag_name} />
            <span className='text text-muted ml-3 text-capitalize'>{props.data.flag_name}</span>
        </button>
    );
};

const ControlComponent = ({ children, ...rest }) => (
    <components.Control {...rest}>
        {rest.hasValue ?
            <img className="h-20px w-20px rounded-sm ml-2" src={rest.getValue()[0].flag_path} alt={rest.getValue()[0].flag_name} />
            :  ''}
        {children}
    </components.Control>
);


const FlagsSelectComponent = ({flagValue='flag_svg', ...props}) => {
    return (
        <SelectComponent
            {...props}
            getOptionLabel={(option) => option.flag_name}
            getOptionValue={(option) => option[flagValue]}
            components={{Option, Control: ControlComponent}}
        />
    );
}

export default FlagsSelectComponent;
