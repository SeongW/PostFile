package org.dao;

import java.util.List;

import org.dao.imp.Dldao;
import org.model.DlbEntity;

import org.springframework.orm.hibernate4.support.HibernateDaoSupport;


/**
 * Created by wujiacheng on 16/5/31.
 */
public class DlDaoImp extends HibernateDaoSupport implements Dldao {


    @Override
    public void save(DlbEntity dl) {
        getHibernateTemplate().save(dl);
    }

    @Override
    public DlbEntity find(String xh, String kl) {
        String str[]={xh,kl};
        List list=getHibernateTemplate().find("from DlbEntity where xh=? and kl=?",str);
        if(list.size()>0)
            return (DlbEntity) list.get(0);
        else
            return null;
    }

    @Override
    public boolean existXh(String xh) {
        List list=getHibernateTemplate().find("from DlbEntity where xh=?",xh);
        if(list.size()>0)
            return true;
        else
            return false;
    }
}
