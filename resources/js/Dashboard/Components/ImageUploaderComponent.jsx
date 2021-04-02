import React from 'react';
import ImageUploading from 'react-images-uploading';

const ImageUploaderComponent = ({children, multiple=false, onImagesChange, ...props}) => {
    const [images, setImages] = React.useState([]);
    const onChange = (imageList, addUpdateIndex) => {
        setImages(imageList);
        onImagesChange(imageList, addUpdateIndex);
    };

    return (
        <ImageUploading
            multiple={multiple}
            value={images}
            onChange={onChange}
            {...props}
        >
            {({
                  imageList,
                  onImageUpload,
                  onImageRemoveAll,
                  onImageUpdate,
                  onImageRemove,
                  isDragging,
                  dragProps,
                  errors
              }) => (
                <>
                {errors && <div>
                                {errors.maxNumber && <span>Number of selected images exceed maxNumber</span>}
                                {errors.acceptType && <span>Your selected file type is not allow</span>}
                                {errors.maxFileSize && <span>Selected file size exceed maxFileSize</span>}
                                {errors.resolution && <span>Selected file is not match your desired resolution</span>}
                             </div>
                    }
                    <div className="upload__image-wrapper">
                        <button
                            type='button'
                            className='btn form-control form-control-solid'
                            style={isDragging ? { color: 'red' } : undefined}
                            onClick={onImageUpload}
                            {...dragProps}
                        >
                            Click or Drop here
                        </button>
                        &nbsp;
                        {multiple && <button className='btn btn-danger' onClick={onImageRemoveAll}>Remove all images</button>}
                        {imageList.map((image, index) => (
                            <div key={index} className="d-inline-block position-relative">
                                <button type='button' className='btn btn-icon btn-xs btn-circle btn-white btn-hover-text-primary btn-shadow btn-image-delete' onClick={() => onImageRemove(index)}>
                                    <i className='flaticon2-delete text-muted icon-sm'></i>
                                </button>
                                <div className='image-input image-input-outline'>
                                    <div className='image-input-wrapper d-inline-block m-2' style={{backgroundImage: 'url('+image['data_url']+')'}}></div>
                                </div>
                            </div>
                        ))}
                    </div>
                </>
            )}
        </ImageUploading>
    );
}

export default ImageUploaderComponent;
