<?php declare(strict_types=1);


namespace Modules\Extras\DataTransferObjects;


use Illuminate\Http\UploadedFile;
use Support\Abstracts\DataTransferObject;


class MediaFromFileDto extends DataTransferObject
{
    /**
     * @var UploadedFile
     */
    public UploadedFile $file;

    /**
     * @var ?string
     */
    public ?string $customName;

    /**
     * @param UploadedFile $file
     * @param ?string $customName
     */
    public function __construct(UploadedFile $file, ?string $customName = null)
    {
        $this->file = $file;
        $this->customName = $customName;
    }
}
