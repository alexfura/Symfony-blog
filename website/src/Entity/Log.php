<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Log
 *
 * @ORM\Table(name="log")
 * @ORM\Entity
 */
class Log
{
    /**
     * @var int
     *
     * @ORM\Column(name="log_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="log_log_id_seq", allocationSize=1, initialValue=1)
     */
    private $logId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="log_date", type="datetime", nullable=false)
     */
    private $logDate;

    /**
     * @var string
     *
     * @ORM\Column(name="log_type", type="string", nullable=true)
     */
    private $logType;

    /**
     * @var string
     *
     * @ORM\Column(name="table_name", type="string", nullable=true)
     */
    private $tableName;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", nullable=true)
     */
    private $userName;

    /**
     * @var string
     *
     * @ORM\Column(name="original_data", type="string", nullable=true)
     */
    private $originalData;

    /**
     * @var string
     *
     * @ORM\Column(name="new_data", type="string", nullable=true)
     */
    private $newData;

    /**
     * @var string
     *
     * @ORM\Column(name="query", type="string", nullable=true)
     */
    private $query;

    /**
     * @return int
     */
    public function getLogId(): int
    {
        return $this->logId;
    }

    /**
     * @param int $logId
     */
    public function setLogId(int $logId): void
    {
        $this->logId = $logId;
    }

    /**
     * @return \DateTime
     */
    public function getLogDate(): \DateTime
    {
        return $this->logDate;
    }

    /**
     * @param \DateTime $logDate
     */
    public function setLogDate(\DateTime $logDate): void
    {
        $this->logDate = $logDate;
    }

    /**
     * @return string
     */
    public function getLogType(): string
    {
        return $this->logType;
    }

    /**
     * @param string $logType
     */
    public function setLogType(string $logType): void
    {
        $this->logType = $logType;
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }

    /**
     * @param string $tableName
     */
    public function setTableName(string $tableName): void
    {
        $this->tableName = $tableName;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getOriginalData(): string
    {
        return $this->originalData;
    }

    /**
     * @param string $originalData
     */
    public function setOriginalData(string $originalData): void
    {
        $this->originalData = $originalData;
    }

    /**
     * @return string
     */
    public function getNewData(): string
    {
        return $this->newData;
    }

    /**
     * @param string $newData
     */
    public function setNewData(string $newData): void
    {
        $this->newData = $newData;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @param string $query
     */
    public function setQuery(string $query): void
    {
        $this->query = $query;
    }
}
