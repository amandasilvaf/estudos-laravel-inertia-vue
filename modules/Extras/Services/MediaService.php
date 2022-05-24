<?php declare(strict_types=1);


namespace Modules\Extras\Services;

use Throwable;
use Illuminate\Support\Facades\Storage;
use Support\Exceptions\DefaultException;
use Modules\Extras\Models\Media;
use Modules\Extras\DataTransferObjects\MediaFromFileDto;
use Modules\Extras\Repositories\MediasRepository;
use Modules\Extras\ValueObjects\UploadedMedia;
use Modules\Extras\ValueObjects\LocalMedia;



class MediaService
{



    /**
     * @param MediaFromFileDto $mediaFromFileDto
     * @return Media
     * @throws DefaultException
     */
    public function createFromUploadedFile(MediaFromFileDto $mediaFromFileDto): Media
    {
        $uploadMedia = new UploadedMedia($mediaFromFileDto->file, $mediaFromFileDto->customName);

        try {
            Storage::put($uploadMedia->getKey(), file_get_contents($uploadMedia->getRealPath()));
        } catch (Throwable $th) {
            throw new DefaultException(message: 'Failed to put media on disk.', originTh: $th);
        }

        $mediasRepository = new MediasRepository;

        return $mediasRepository->create([
            'name' => $uploadMedia->getName(),
            'path' => $uploadMedia->getPath(),
            'key' => $uploadMedia->getKey(),
            'url' => $uploadMedia->getUrl(),
            'mimetype' => $uploadMedia->getMimeType(),
            'extension' => $uploadMedia->getExtension(),
            'size' => $uploadMedia->getSize()
         
        ]);
    }

    /**
     * @param string $path
     * @return Media
     * @throws DefaultException
     */
    public function createFromLocalFile(string $path): Media
    {
        $localMedia = new LocalMedia($path);

        try {
            Storage::put($localMedia->getKey(), file_get_contents($localMedia->getRealPath()));
        } catch (Throwable $th) {
            throw new DefaultException(message: 'Failed to put media on disk.', originTh: $th);
        }

        $mediasRepository = new MediasRepository;

        return $mediasRepository->create([
            'name' => $localMedia->getName(),
            'path' => $localMedia->getPath(),
            'key' => $localMedia->getKey(),
            'url' => $localMedia->getUrl(),
            'mimetype' => $localMedia->getMimeType(),
            'extension' => $localMedia->getExtension(),
            'size' => $localMedia->getSize()

        ]);
    }

    /**
     * @param int $mediaId
     * @param bool $force
     * @throws DefaultException
     */
    public function delete(int $mediaId, bool $force = false): void
    {
        //dd($mediaId, 'do MediaServicesss');
        $mediasRepository = new MediasRepository;

        $media = $mediasRepository->find($mediaId);

        $mediasRepository->delete($mediaId, $force);

        $key = $media['path'] . '/' . $media['name'];
        //$key = $media['key'];

        if ($force) {
            try {
                Storage::delete($key);
            } catch (Throwable $th) {
                throw new DefaultException(message: 'Failed to delete media from disk.', originTh: $th);
            }
        }

        
    }
}
