package org.service;

import org.dao.imp.Zydao;
import org.model.ZybEntity;

import java.util.List;

/**
 * Created by wujiacheng on 16/6/5.
 */
public class ZyServiceManage implements ZyService {
    private Zydao zydao;

    public Zydao getZydao() {
        return zydao;
    }

    public void setZydao(Zydao zydao) {
        this.zydao = zydao;
    }

    @Override
    public void save(ZybEntity zy) {
        zydao.save(zy);
    }

    @Override
    public ZybEntity getOneZy(int zyId) {
        return zydao.getOneZy(zyId);
    }

    @Override
    public List getAll() {
        return zydao.getAll();
    }
}
