<?php


namespace Modules\Extras\ValueObjects;


use Illuminate\Http\UploadedFile;


class UploadedMedia extends AbstractMedia
{
    /**
     * @param UploadedFile $uploadedFile
     * @param ?string $name
     */
    public function __construct(UploadedFile $uploadedFile, ?string $name = null)
    {
        $this->mimeType = $uploadedFile->getClientMimeType();
        $this->extension = $uploadedFile->getClientOriginalExtension();
        $this->name = $this->generateUniqueName(
            name: $name ?? $uploadedFile->getClientOriginalName(),
            extension: $this->extension,
        );
        $this->path = $this->generatePath($this->mimeType);
        $this->key = $this->path . '/' . $this->name;
        $this->url = $this->generateUrl($this->key);
        $this->realPath = $uploadedFile->getRealPath();
        $this->size = $uploadedFile->getSize();
        $this->data = $this->getImageDimensions($uploadedFile->getRealPath(), $uploadedFile->getMimeType());
    }
}
