package org.dao;

import org.dao.imp.Kcdao;
import org.model.KcbEntity;
import org.springframework.orm.hibernate4.support.HibernateDaoSupport;

import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;


import java.util.List;

/**
 * Created by wujiacheng on 16/6/5.
 */
public class KcDaoImp extends HibernateDaoSupport implements Kcdao {
    @Override
    public void save(KcbEntity kc) {
        getHibernateTemplate().save(kc);
    }

    @Override
    public void delete(String kch) {
        getHibernateTemplate().delete(find(kch));
    }

    @Override
    public void update(KcbEntity kc) {
        getHibernateTemplate().update(kc);
    }

    @Override
    public KcbEntity find(String kch) {
        List list=getHibernateTemplate().find("from KcbEntity where kch=?",kch);
        if(list.size()>0)
            return (KcbEntity) list.get(0);
        else
            return null;

    }

    @Override
    public List findAll(int pageNow, int pageSize) {
        Session session=getHibernateTemplate().getSessionFactory().openSession();
        Transaction ts=session.beginTransaction();
        Query query=session.createQuery("from KcbEntity order by kch");
        int firstResult=(pageNow-1)*pageSize;
        query.setFirstResult(firstResult);
        query.setMaxResults(pageSize);
        List list=query.list();
        ts.commit();
        session.close();
        session=null;
        return list;


    }

    @Override
    public int findKcSize() {
        return getHibernateTemplate().find("from KcbEntity ").size();
    }
}
