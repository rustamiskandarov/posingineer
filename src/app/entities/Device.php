<?php

namespace App\entities;

class Device
{
    private int $id;
    private DeviceType $deviceType;
    private string $serialNumber;
    private DeviceStatus $deviceStatus;
    private string $idDevice;
    private array $network_type;
    private string $model;
    private string $brand;

    /**
     * @param int $id
     * @param DeviceType $deviceType
     * @param string $serialNumber
     * @param DeviceStatus $deviceStatus
     * @param string $idDevice
     * @param array $network_type
     * @param string $model
     * @param string $brand
     */
    public function __construct(int $id, DeviceType $deviceType, string $serialNumber, DeviceStatus $deviceStatus, string $idDevice, array $network_type, string $model, string $brand)
    {
        $this->id = $id;
        $this->deviceType = $deviceType;
        $this->serialNumber = $serialNumber;
        $this->deviceStatus = $deviceStatus;
        $this->idDevice = $idDevice;
        $this->network_type = $network_type;
        $this->model = $model;
        $this->brand = $brand;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return DeviceType
     */
    public function getDeviceType(): DeviceType
    {
        return $this->deviceType;
    }

    /**
     * @param DeviceType $deviceType
     */
    public function setDeviceType(DeviceType $deviceType): void
    {
        $this->deviceType = $deviceType;
    }

    /**
     * @return string
     */
    public function getSerialNumber(): string
    {
        return $this->serialNumber;
    }

    /**
     * @param string $serialNumber
     */
    public function setSerialNumber(string $serialNumber): void
    {
        $this->serialNumber = $serialNumber;
    }

    /**
     * @return DeviceStatus
     */
    public function getDeviceStatus(): DeviceStatus
    {
        return $this->deviceStatus;
    }

    /**
     * @param DeviceStatus $deviceStatus
     */
    public function setDeviceStatus(DeviceStatus $deviceStatus): void
    {
        $this->deviceStatus = $deviceStatus;
    }

    /**
     * @return string
     */
    public function getIdDevice(): string
    {
        return $this->idDevice;
    }

    /**
     * @param string $idDevice
     */
    public function setIdDevice(string $idDevice): void
    {
        $this->idDevice = $idDevice;
    }

    /**
     * @return array
     */
    public function getNetworkType(): array
    {
        return $this->network_type;
    }

    /**
     * @param array $network_type
     */
    public function setNetworkType(array $network_type): void
    {
        $this->network_type = $network_type;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }




}