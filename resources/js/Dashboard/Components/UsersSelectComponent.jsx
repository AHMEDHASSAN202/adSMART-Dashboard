import SelectComponent from "./Select";
import {assets} from "../helpers";

const Option = props => {
    const { innerProps, innerRef } = props;
    return (
        <button ref={innerRef} {...innerProps} className='p-3 border-0 d-block bg-transparent'>
            <img className="h-20px w-20px rounded-sm" src={assets(props.data.user_avatar)} alt={props.data.user_name} />
            <span className='text text-muted ml-3 text-capitalize'>{props.data.user_name}</span>
        </button>
    );
};

const UsersSelectComponent = ({...props}) => {
    return (
        <SelectComponent
            isMulti
            {...props}
            getOptionLabel={(option) => option.user_name}
            getOptionValue={(option) => option.user_id}
            components={{Option}}
        />
    );
}

export default UsersSelectComponent;
