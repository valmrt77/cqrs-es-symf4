<?php

namespace App\Infrastructure\Persistence;

use App\Model\Order\OrderView;
use Symfony\Component\Filesystem\Filesystem;

class OrderViewMapper
{
    /**
     * @var string
     */
    private $publicDir;

    /**
     * @var string
     */
    private $imageDir;

    /**
     * @var string
     */
    private $noImage;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @param string     $publicDir
     * @param string     $imageDir
     * @param string     $noImage
     * @param Filesystem $filesystem
     */
    public function __construct(string $publicDir, string $imageDir, string $noImage, Filesystem $filesystem)
    {
        $this->publicDir = $publicDir;
        $this->imageDir = $imageDir;
        $this->noImage = $noImage;
        $this->filesystem = $filesystem;
    }

    public function map(array $data): OrderView
    {
        return new OrderView(
            $data['id'],
            $data['plateId'],
            $data['customerName'],
            $data['createdAt'],
            $data['updatedAt']
        );
    }
}
