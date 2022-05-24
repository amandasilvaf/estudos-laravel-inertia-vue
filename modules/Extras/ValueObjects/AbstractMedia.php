<?php


namespace Modules\Extras\ValueObjects;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;


abstract class AbstractMedia
{
    /** @var string */
    protected string $name;

    /** @var string */
    protected string $path;

    /** @var string */
    protected string $key;

    /** @var string */
    protected string $url;

    /** @var string */
    protected string $mimeType;

    /** @var string */
    protected string $extension;

    /** @var string */
    protected string $realPath;

    /** @var string */
    protected string $size;
    
    /**
     * @param string $name
     * @param string $extension
     * @return string
     */
    protected function generateUniqueName(string $name, string $extension): string
    {
        return Str::slug(File::name($name)) . '-' . Carbon::now()->timestamp . '.' . $extension;
    }

    /**
     * @param string $mimeType
     * @return string
     */
    protected function generatePath(string $mimeType): string
    {
        $folder = match ($mimeType) {
            'image/jpeg', 'image/gif', 'image/png', 'image/svg+xml' => "images",
            'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'text/csv' , 'application/csv' => "spreadsheets",
            default => "files"
        };

        $now = Carbon::now();

        return $folder . '/' . $now->format('Y') . '/' . $now->format('m');
    }

    protected function generateUrl(string $key): string
    {
        return Storage::url($key);
    }

    /**
     * @param string $path
     * @param string $mimeType
     * @return ?array
     */
    protected function getImageDimensions(string $path, string $mimeType): ?array
    {
        if (!str_contains($mimeType, 'image')) {
            return null;
        }

        list($width, $height) = getimagesize($path);

        return [
            'dimensions' => [
                'width' => $width,
                'height' => $height,
            ]
        ];
    }

    /** @return string */
    public function getName(): string
    {
        return $this->name;
    }

    /** @return string */
    public function getPath(): string
    {
        return $this->path;
    }

    /** @return string */
    public function getKey(): string
    {
        return $this->key;
    }

    /** @return string */
    public function getUrl(): string
    {
        return $this->url;
    }

    /** @return string */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /** @return string */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /** @return string */
    public function getRealPath(): string
    {
        return $this->realPath;
    }

    /** @return string */
    public function getSize(): string
    {
        return $this->size;
    }
}
