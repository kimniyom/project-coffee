<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Stockproduct;

/**
 * StockSearch represents the model behind the search form about `app\models\Stockproduct`.
 */
class StockproductSearch extends Stockproduct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category','unit'], 'integer'],
            [['productname', 'create_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Stockproduct::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category' => $this->category,
            'unit' => $this->unit,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'productname', $this->productname]);

        return $dataProvider;
    }
}
