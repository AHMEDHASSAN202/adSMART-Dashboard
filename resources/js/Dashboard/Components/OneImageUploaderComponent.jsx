import React from 'react';
import ImageUploading from 'react-images-uploading';

const OneImageUploaderComponent = ({defaultImage={}, onImagesChange, ...props}) => {
    const [images, setImages] = React.useState([defaultImage]);
    const onChange = (imageList) => {
        setImages(imageList);
        onImagesChange(imageList[0]);
    };

    return (
        <ImageUploading
            multiple={false}
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

                        <div className="d-inline-block position-relative">
                            <button type='button'
                                    className='btn btn-icon btn-xs btn-circle btn-white btn-hover-text-primary btn-shadow btn-image-delete'
                                    style={isDragging ? { color: 'red' } : undefined}
                                    onClick={onImageUpload}
                                    {...dragProps}
                            >
                                <i className='flaticon2-pen text-muted icon-sm'></i>
                            </button>
                            <div className='image-input image-input-outline'>
                                <div className='image-input-wrapper d-inline-block m-2' style={{backgroundImage: 'url('+images[0]['dataURL']+')'}}></div>
                            </div>
                        </div>
                    </div>
                </>
            )}
        </ImageUploading>
    );
}

export default OneImageUploaderComponent;
