import {useState} from 'react';
import SortableTree from 'react-sortable-tree';
import {toggleExpandedForAll} from 'react-sortable-tree';

const TreeComponent = ({treeData, onChange, defaultExpanded=true, ...props}) => {
    const [expanded, setExpanded] = useState(defaultExpanded);
    return (
        <>
            <div className='d-flex justify-content-end'>
                <button className='btn btn-outline-info btn-sm' onClick={() => setExpanded(!expanded)}>{translations['toggle_collapse']}</button>
            </div>
            <SortableTree
                treeData={toggleExpandedForAll({treeData, expanded: expanded})}
                onChange={onChange}
                isVirtualized={false}
                rowDirection={window.currentLanguage.language_direction}
                maxDepth={10}
                {...props}
            />
        </>
    )
}

export default TreeComponent;
