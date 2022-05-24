<?php


namespace Modules\Extras\ValueObjects;


class LocalMedia extends AbstractMedia
{
    /**
     * @param string $path
     * @param ?string $name
     */
    public function __construct(string $path, ?string $name = null)
    {
        $pathInfo = pathinfo($path);
        $this->mimeType = mime_content_type($path);
        $this->extension = $pathInfo['extension'];
        $this->name = $this->generateUniqueName(
            name: $name ?? $pathInfo['basename'],
            extension: $this->extension,
        );
        $this->path = $this->generatePath($this->mimeType);
        $this->key = $this->path . '/' . $this->name;
        $this->url = $this->generateUrl($this->key);
        $this->realPath = $path;
        $this->size = filesize($path);
    }
}
