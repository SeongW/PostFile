package org.dao;

import org.dao.imp.Zydao;
import org.model.ZybEntity;
import org.springframework.orm.hibernate4.support.HibernateDaoSupport;

import java.util.List;

/**
 * Created by wujiacheng on 16/6/5.
 */
public class ZyDaoImp extends HibernateDaoSupport implements Zydao {

    @Override
    public void save(ZybEntity zy) {


        getHibernateTemplate().save(zy);
    }

    @Override
    public ZybEntity getOneZy(int zyId) {
        return (ZybEntity) getHibernateTemplate().find("from ZybEntity where id=?",zyId).get(0);
    }

    @Override
    public List getAll() {
        return this.getHibernateTemplate().find("from ZybEntity ");
    }
}
