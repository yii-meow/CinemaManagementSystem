<?php

namespace DoctrineProxies\__CG__\App\models;


/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class UserReward extends \App\models\UserReward implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array<string, null> properties to be lazy loaded, indexed by property name
     */
    public static $lazyPropertiesNames = array (
);

    /**
     * @var array<string, mixed> default values of properties to be lazy loaded, with keys being the property names
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array (
);



    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'App\\models\\UserReward' . "\0" . 'userRewardId', '' . "\0" . 'App\\models\\UserReward' . "\0" . 'userId', '' . "\0" . 'App\\models\\UserReward' . "\0" . 'rewardId', '' . "\0" . 'App\\models\\UserReward' . "\0" . 'status', '' . "\0" . 'App\\models\\UserReward' . "\0" . 'redeemDate'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\models\\UserReward' . "\0" . 'userRewardId', '' . "\0" . 'App\\models\\UserReward' . "\0" . 'userId', '' . "\0" . 'App\\models\\UserReward' . "\0" . 'rewardId', '' . "\0" . 'App\\models\\UserReward' . "\0" . 'status', '' . "\0" . 'App\\models\\UserReward' . "\0" . 'redeemDate'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (UserReward $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy::$lazyPropertiesDefaults as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load(): void
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized(): bool
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized): void
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(?\Closure $initializer = null): void
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer(): ?\Closure
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(?\Closure $cloner = null): void
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner(): ?\Closure
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @deprecated no longer in use - generated code now relies on internal components rather than generated public API
     * @static
     */
    public function __getLazyProperties(): array
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getUserRewardId(): ?int
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getUserRewardId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUserRewardId', []);

        return parent::getUserRewardId();
    }

    /**
     * {@inheritDoc}
     */
    public function getUserId(): int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUserId', []);

        return parent::getUserId();
    }

    /**
     * {@inheritDoc}
     */
    public function setUserId(int $userId): \App\models\UserReward
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUserId', [$userId]);

        return parent::setUserId($userId);
    }

    /**
     * {@inheritDoc}
     */
    public function getRewardId(): int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRewardId', []);

        return parent::getRewardId();
    }

    /**
     * {@inheritDoc}
     */
    public function setRewardId(int $rewardId): \App\models\UserReward
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRewardId', [$rewardId]);

        return parent::setRewardId($rewardId);
    }

    /**
     * {@inheritDoc}
     */
    public function getStatus(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStatus', []);

        return parent::getStatus();
    }

    /**
     * {@inheritDoc}
     */
    public function setStatus(string $status): \App\models\UserReward
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStatus', [$status]);

        return parent::setStatus($status);
    }

    /**
     * {@inheritDoc}
     */
    public function getRedeemDate(): ?\DateTime
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRedeemDate', []);

        return parent::getRedeemDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setRedeemDate(?\DateTime $redeemDate): \App\models\UserReward
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRedeemDate', [$redeemDate]);

        return parent::setRedeemDate($redeemDate);
    }

}
